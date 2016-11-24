<?php

$app->post('/api/AmazonCloudWatch/putMetricAlarm', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','alarmName','comparisonOperator','evaluationPeriods','metricName','namespace','period','threshold']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    
    $credentials = new Aws\Credentials\Credentials($post_data['args']['apiKey'], $post_data['args']['apiSecret']);

    $client = new Aws\CloudWatch\CloudWatchClient([
        'version'     => 'latest',
        'region'      => $post_data['args']['region'],
        'credentials' => $credentials
    ]);
    
    $body['AlarmName'] = $post_data['args']['alarmName'];
    $body['ComparisonOperator'] = $post_data['args']['comparisonOperator'];
    $body['EvaluationPeriods'] = $post_data['args']['evaluationPeriods'];
    $body['MetricName'] = $post_data['args']['metricName'];
    $body['Namespace'] = $post_data['args']['namespace'];
    $body['Period'] = $post_data['args']['period'];
    $body['Threshold'] = $post_data['args']['threshold'];
    
    if(!empty($post_data['args']['actionsEnabled'])) {
        $body['ActionsEnabled'] = $post_data['args']['actionsEnabled'];
    }
    if(!empty($post_data['args']['alarmActions'])) {
        $body['AlarmActions'] = $post_data['args']['alarmActions'];
    }
    if(!empty($post_data['args']['alarmDescription'])) {
        $body['AlarmDescription'] = $post_data['args']['alarmDescription'];
    }
    if(!empty($post_data['args']['dimensions'])) {
        $body['Dimensions'] = $post_data['args']['dimensions'];
    }
    if(!empty($post_data['args']['extendedStatistic'])) {
        $body['ExtendedStatistic'] = $post_data['args']['extendedStatistic'];
    }
    if(!empty($post_data['args']['insufficientDataActions'])) {
        $body['InsufficientDataActions'] = $post_data['args']['insufficientDataActions'];
    }
    if(!empty($post_data['args']['oKActions'])) {
        $body['OKActions'] = $post_data['args']['oKActions'];
    }
    if(!empty($post_data['args']['statistic'])) {
        $body['Statistic'] = $post_data['args']['statistic'];
    }
    if(!empty($post_data['args']['unit'])) {
        $body['Unit'] = $post_data['args']['unit'];
    }
    
    try {
        if(!empty($body)) {
            $res = $client->putMetricAlarm(
                $body
            )->toArray();
        } else {
            $res = $client->putMetricAlarm()->toArray();
        }
        
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = is_array($res) ? $res : json_decode($res);
        if(empty($result['contextWrites']['to'])) {
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
