<?php

$app->post('/api/AmazonCloudWatch/getMetricStatistics', function ($request, $response, $args) {

    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'region', 'endTime', 'metricName', 'namespace', 'period', 'startTime']);
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
    $endDateTime = new DateTime($post_data['args']['endTime']);
    $body['EndTime'] = $endDateTime->format('Y-m-d\TH:i:s\Z');
    $body['MetricName'] = $post_data['args']['metricName'];
    $body['Namespace'] = $post_data['args']['namespace'];
    $body['Period'] = $post_data['args']['period'];
    $startDateTime = new DateTime($post_data['args']['startTime']);
    $body['StartTime'] = $startDateTime->format('Y-m-d\TH:i:s\Z');

    if (!empty($post_data['args']['dimensions'])) {
        $body['Dimensions'] = $post_data['args']['dimensions'];
    }
    if (!empty($post_data['args']['extendedStatistics'])) {
        $body['ExtendedStatistics'] = $post_data['args']['extendedStatistics'];
    }
    if (!empty($post_data['args']['statistics'])) {
        $body['Statistics'] = $post_data['args']['statistics'];
    }
    if (!empty($post_data['args']['unit'])) {
        $body['Unit'] = $post_data['args']['unit'];
    }

    try {
        if (!empty($body)) {
            $res = $client->getMetricStatistics(
                $body
            )->toArray();
        } else {
            $res = $client->getMetricStatistics()->toArray();
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
