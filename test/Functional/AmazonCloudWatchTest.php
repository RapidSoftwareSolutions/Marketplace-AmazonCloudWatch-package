<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');

class AmazonCloudWatchTest extends BaseTestCase {
    
    public function testListMetrics() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "dimensions":"",
                        "metricName":"",
                        "namespace":"",
                        "nextToken":""
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/listMetrics', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testGetMetricStatistics() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "dimensions":"",
                        "endTime":"2016-11-22",
                        "extendedStatistics":"",
                        "metricName":"test_metric_new",
                        "namespace":"test/metric",
                        "period":"600",
                        "startTime":"2016-11-20",
                        "statistics":["Average", "Sum"],
                        "unit":""
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/getMetricStatistics', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testPutMetricAlarm() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "actionsEnabled":"",
                        "alarmActions":"",
                        "alarmDescription":"",
                        "alarmName":"test alarm",
                        "comparisonOperator":"GreaterThanOrEqualToThreshold",
                        "dimensions":"",
                        "evaluationPeriods":"2",
                        "extendedStatistic":"",
                        "insufficientDataActions":"",
                        "metricName":"test_metric_new",
                        "namespace":"test/metric",
                        "OKActions":"",
                        "period":"60",
                        "statistic":"Average",
                        "threshold":"80",
                        "unit":""
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/putMetricAlarm', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testPutMetricData() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "dimensions":"",
                        "metricName":"new_metric",
                        "statisticValues":"",
                        "timestamp":"",
                        "unit":"",
                        "value":"100",
                        "namespace":"test/metric"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/putMetricData', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testSetAlarmState() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "alarmName":"test alarm",
                        "stateReason":"test",
                        "stateReasonData":"",
                        "stateValue":"OK"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/setAlarmState', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDeleteAlarms() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "alarmNames":["test alarm"]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/deleteAlarms', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDescribeAlarmHistory() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "alarmName":"test alarm",
                        "endDate":"",
                        "historyItemType":"",
                        "maxRecords":"",
                        "nextToken":"",
                        "startDate":""
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/describeAlarmHistory', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDescribeAlarms() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "actionPrefix":"",
                        "alarmNamePrefix":"",
                        "AlarmNames":"",
                        "maxRecords":"",
                        "nextToken":"",
                        "stateValue":""
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/describeAlarms', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDescribeAlarmsForMetric() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "dimensions":"",
                        "extendedStatistic":"",
                        "metricName":"new_metric",
                        "namespace":"test/metric",
                        "period":"",
                        "statistic":"",
                        "unit":""
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/describeAlarmsForMetric', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDisableAlarmActions() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "alarmNames":["test alarm"]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/disableAlarmActions', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testEnableAlarmActions() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAIGQWPEB5RDKLCUEA",
                        "apiSecret":"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",
                        "region":"eu-central-1",
                        "alarmNames":["test alarm"]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonCloudWatch/enableAlarmActions', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
}
