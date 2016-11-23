<?php

$app->post('/api/AmazonCloudWatch/setAlarmState', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','alarmName','stateReason','stateValue']);
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
    $body['StateReason'] = $post_data['args']['stateReason'];
    $body['StateValue'] = $post_data['args']['stateValue'];
    if(!empty($post_data['args']['stateReasonData'])) {
        $body['StateReasonData'] = $post_data['args']['stateReasonData'];
    }
    
    try {
        if(!empty($body)) {
            $res = $client->setAlarmState(
                $body
            )->toArray();
        } else {
            $res = $client->setAlarmState()->toArray();
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
