<?php

$app->post('/api/AmazonCloudWatch/putMetricData', function ($request, $response, $args) {

    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'region', 'metricName', 'namespace']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $credentials = new Aws\Credentials\Credentials($post_data['args']['apiKey'], $post_data['args']['apiSecret']);

    $client = new Aws\CloudWatch\CloudWatchClient([
        'version' => 'latest',
        'region' => $post_data['args']['region'],
        'credentials' => $credentials
    ]);

    $body['Namespace'] = $post_data['args']['namespace'];
    $metricData['MetricName'] = $post_data['args']['metricName'];

    if (!empty($post_data['args']['dimensions'])) {
        $metricData['Dimensions'] = $post_data['args']['dimensions'];
    }
    if (!empty($post_data['args']['statisticValues'])) {
        $metricData['StatisticValues'] = $post_data['args']['statisticValues'];
    }
    if (!empty($post_data['args']['timestamp'])) {
        if (is_numeric($post_data['args']['timestamp'])) {
            $timestamp = $post_data['args']['timestamp'];
        } else {
            $dateTime = new DateTime($post_data['args']['timestamp']);
            $timestamp = $dateTime->format('U');
        }
        $metricData['Timestamp'] = $timestamp;
    }
    if (!empty($post_data['args']['unit'])) {
        $metricData['Unit'] = $post_data['args']['unit'];
    }
    if (!empty($post_data['args']['value'])) {
        $metricData['Value'] = $post_data['args']['value'];
    }

    $body['MetricData'][] = $metricData;

    try {
        if (!empty($body)) {
            $res = $client->putMetricData(
                $body
            )->toArray();
        } else {
            $res = $client->putMetricData()->toArray();
        }

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = is_array($res) ? $res : json_decode($res);
        if (empty($result['contextWrites']['to'])) {
            $result['contextWrites']['to']['status_msg'] = "Api return no results";
        }
    } catch (S3Exception $e) {
        // Catch an S3 specific exception.
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    } catch (Aws\CloudWatch\Exception\CloudWatchException $e) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    } catch (\Exception $e) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});
