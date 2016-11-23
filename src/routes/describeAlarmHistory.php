<?php

$app->post('/api/AmazonCloudWatch/describeAlarmHistory', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region']);
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
    
    $body = [];
    if(!empty($post_data['args']['alarmName'])) {
        $body['AlarmName'] = $post_data['args']['alarmName'];
    }
    if(!empty($post_data['args']['endDate'])) {
        $body['EndDate'] = $post_data['args']['endDate'];
    }
    if(!empty($post_data['args']['historyItemType'])) {
        $body['HistoryItemType'] = $post_data['args']['historyItemType'];
    }
    if(!empty($post_data['args']['maxRecords'])) {
        $body['MaxRecords'] = $post_data['args']['maxRecords'];
    }
    if(!empty($post_data['args']['nextToken'])) {
        $body['NextToken'] = $post_data['args']['nextToken'];
    }
    if(!empty($post_data['args']['startDate'])) {
        $body['StartDate'] = $post_data['args']['startDate'];
    }
    
    try {
        if(!empty($body)) {
            $res = $client->describeAlarmHistory(
                $body
            )->toArray();
        } else {
            $res = $client->describeAlarmHistory()->toArray();
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
