<?php
$routes = [
    'listMetrics',
    'getMetricStatistics',
    'putMetricAlarm',
    'putMetricData',
    'setAlarmState',
    'deleteAlarms',
    'describeAlarmHistory',
    'describeAlarms',
    'describeAlarmsForMetric',
    'disableAlarmActions',
    'enableAlarmActions',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

