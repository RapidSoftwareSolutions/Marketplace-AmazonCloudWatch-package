[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/AmazonCloudWatch/functions?utm_source=RapidAPIGitHub_AmazonCloudWatchFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# AmazonCloudWatch Package
Monitor your AWS resources in near real-time.
* Domain: [AmazonCloudWatch](http://amazon.com)
* Credentials: apiKey, apiSecret

## How to get credentials: 
## How to get credentials:

0. Go to the [AWS Console](https://console.aws.amazon.com/console/home?region=us-east-1)
1. Log in or create new account
2. Navigate to the [Security Credentials page](https://console.aws.amazon.com/iam/home?#/security_credential)
3. Click "create new access key" to generate your credentials




## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```

 #### region possible values
 
 | Region         | Region name
 |----------------|------------
 | us-east-1      | US East (N. Virginia)
 | us-east-2      | US East (Ohio)
 | us-west-1      | US West (N. California)
 | us-west-2      | US West (Oregon)
 | ap-south-1     | Asia Pacific (Mumbai)
 | ap-northeast-2 | Asia Pacific (Seoul)
 | ap-southeast-1 | Asia Pacific (Singapore)
 | ap-southeast-2 | Asia Pacific (Sydney)
 | ap-northeast-1 | Asia Pacific (Tokyo)
 | eu-central-1   | EU (Frankfurt)
 | eu-west-1      | EU (Ireland)
 | sa-east-1      | South America (São Paulo)

## AmazonCloudWatch.listMetrics
This endpoint allows to retrive list the specified metrics.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| API key obtained from Amazon.
| apiSecret | credentials| API secret obtained from Amazon.
| region    | String     | The region for endpoint. See README for all possible values.
| dimensions| List       | Array of objects. The dimensions to filter against. Maximum number of 10 items. See README for more details.
| metricName| String     | The name of the metric to filter against. Minimum length of 1. Maximum length of 255.
| namespace | String     | The namespace to filter against. Minimum length of 1. Maximum length of 255. Pattern: [^:].*
| nextToken | String     | The token returned by a previous call to indicate that there is more data available.

## AmazonCloudWatch.getMetricStatistics
This endpoint allows to gets statistics for the specified metric.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| API key obtained from Amazon.
| apiSecret         | credentials| API secret obtained from Amazon.
| region            | String     | The region for endpoint. See README for all possible values.
| dimensions        | List       | Array of objects. The dimensions. CloudWatch treats each unique combination of dimensions as a separate metric. You can't retrieve statistics using combinations of dimensions that were not specially published. You must specify the same dimensions that were used when the metrics were created. See README for more details.
| startTime         | DatePicker | The time stamp that determines the first data point to return. Note that start times are evaluated relative to the time that CloudWatch receives the request. The value specified is inclusive; results include data points with the specified time stamp. The time stamp must be in ISO 8601 UTC format (for example, 2016-10-03T23:00:00Z).
| endTime           | DatePicker | The time stamp that determines the last data point to return. The value specified is exclusive; results will include data points up to the specified time stamp. The time stamp must be in ISO 8601 UTC format (for example, 2016-10-10T23:00:00Z).
| extendedStatistics| List       | Array of strings. The percentile statistics. Specify values between p0.0 and p100. Array Members: Minimum number of 1 item. Maximum number of 10 items. Pattern: p(\d{1,2}(\.\d{0,2})?|100).
| metricName        | String     | The name of the metric, with or without spaces. Minimum length of 1. Maximum length of 255.
| namespace         | String     | The namespace of the metric, with or without spaces. Minimum length of 1. Maximum length of 255. Pattern: [^:].*
| period            | String     | The granularity, in seconds, of the returned data points. A period can be as short as one minute (60 seconds) and must be a multiple of 60. The default value is 60. See README for more details.
| statistics        | List       | Array of strings. The metric statistics, other than percentile. For percentile statistics, use ExtendedStatistic. Minimum number of 1 item. Maximum number of 5 items. Valid Values: SampleCount | Average | Sum | Minimum | Maximum
| unit              | Select     | The unit for a given metric. Metrics may be reported in multiple units. Not supplying a unit results in all units being returned. If the metric only ever reports one unit, specifying a unit has no effect. Valid Values: Seconds | Microseconds | Milliseconds | Bytes | Kilobytes | Megabytes | Gigabytes | Terabytes | Bits | Kilobits | Megabits | Gigabits | Terabits | Percent | Count | Bytes/Second | Kilobytes/Second | Megabytes/Second | Gigabytes/Second | Terabytes/Second | Bits/Second | Kilobits/Second | Megabits/Second | Gigabits/Second | Terabits/Second | Count/Second | None

## AmazonCloudWatch.putMetricAlarm
This endpoint allows to creates or updates an alarm and associates it with the specified metric.

| Field                  | Type       | Description
|------------------------|------------|----------
| apiKey                 | credentials| API key obtained from Amazon.
| apiSecret              | credentials| API secret obtained from Amazon.
| region                 | String     | The region for endpoint. See README for all possible values.
| actionsEnabled         | String     | Indicates whether actions should be executed during any changes to the alarm state. True || false
| alarmActions           | List       | Array of strings. The actions to execute when this alarm transitions to the ALARM state from any other state. Each action is specified as an Amazon Resource Name (ARN). See README for more details.
| alarmDescription       | String     | The description for the alarm. Minimum length of 0. Maximum length of 1024.
| alarmName              | String     | The name for the alarm. This name must be unique within the AWS account. Minimum length of 1. Maximum length of 255.
| comparisonOperator     | String     | The arithmetic operation to use when comparing the specified statistic and threshold. The specified statistic value is used as the first operand. Valid Values: GreaterThanOrEqualToThreshold | GreaterThanThreshold | LessThanThreshold | LessThanOrEqualToThreshold
| dimensions             | List       | Array of objects. The dimensions for the metric associated with the alarm. See README for more details.
| evaluationPeriods      | String     | The number of periods over which data is compared to the specified threshold. Minimum value of 1.
| extendedStatistic      | String     | The percentile statistic for the metric associated with the alarm. Specify a value between p0.0 and p100. Pattern: p(\d{1,2}(\.\d{0,2})?|100)
| insufficientDataActions| List       | Array of strings. Maximum number of 5 items. Minimum length of 1. Maximum length of 1024. Valid Values: arn:aws:automate:region:ec2:stop | arn:aws:automate:region:ec2:terminate | arn:aws:automate:region:ec2:recover. See README for more deatails.
| metricName             | String     | The name for the metric associated with the alarm. Minimum length of 1. Maximum length of 255.
| namespace              | String     | The namespace for the metric associated with the alarm. Minimum length of 1. Maximum length of 255. Pattern: [^:].*
| oKActions              | String     | The actions to execute when this alarm transitions to an OK state from any other state. Each action is specified as an Amazon Resource Name (ARN). Maximum number of 5 items. Minimum length of 1. Maximum length of 1024. Valid Values: arn:aws:automate:region:ec2:stop | arn:aws:automate:region:ec2:terminate | arn:aws:automate:region:ec2:recover. See README for more details.
| period                 | String     | The period, in seconds, over which the specified statistic is applied. Minimum value of 60.
| statistic              | String     | The statistic for the metric associated with the alarm, other than percentile. For percentile statistics, use ExtendedStatistic. Valid Values: SampleCount | Average | Sum | Minimum | Maximum
| threshold              | String     | The value against which the specified statistic is compared.
| unit                   | Select     | The unit of measure for the statistic. Valid Values: Seconds | Microseconds | Milliseconds | Bytes | Kilobytes | Megabytes | Gigabytes | Terabytes | Bits | Kilobits | Megabits | Gigabits | Terabits | Percent | Count | Bytes/Second | Kilobytes/Second | Megabytes/Second | Gigabytes/Second | Terabytes/Second | Bits/Second | Kilobits/Second | Megabits/Second | Gigabits/Second | Terabits/Second | Count/Second | None

## AmazonCloudWatch.putMetricData
Publishes metric data points to Amazon CloudWatch. Amazon CloudWatch associates the data points with the specified metric. If the specified metric does not exist, Amazon CloudWatch creates the metric.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| API key obtained from Amazon.
| apiSecret      | credentials| API secret obtained from Amazon.
| region         | String     | The region for endpoint. See README for all possible values.
| dimensions     | List       | Array of objects. The dimensions associated with the metric. Maximum number of 10 items. See README for more details.
| metricName     | String     | The name of the metric. Minimum length of 1. Maximum length of 255.
| statisticValues| JSON       | Json object. The statistical values for the metric. See README for more details.
| timestamp      | DatePicker | The time the metric data was received, expressed as the number of milliseconds since Jan 1, 1970 00:00:00 UTC.
| unit           | Select     | The unit of the metric. Valid Values: Seconds | Microseconds | Milliseconds | Bytes | Kilobytes | Megabytes | Gigabytes | Terabytes | Bits | Kilobits | Megabits | Gigabits | Terabits | Percent | Count | Bytes/Second | Kilobytes/Second | Megabytes/Second | Gigabytes/Second | Terabytes/Second | Bits/Second | Kilobits/Second | Megabits/Second | Gigabits/Second | Terabits/Second | Count/Second | None
| value          | String     | The value for the metric. Values must be in the range of 8.515920e-109 to 1.174271e+108 (Base 10) or 2e-360 to 2e360 (Base 2). In addition, special values (for example, NaN, +Infinity, -Infinity) are not supported.
| namespace      | String     | The namespace for the metric data. You cannot specify a namespace that begins with "AWS/". Namespaces that begin with "AWS/" are reserved for use by Amazon Web Services products. Minimum length of 1. Maximum length of 255. Pattern: [^:].*

## AmazonCloudWatch.setAlarmState
Temporarily sets the state of an alarm for testing purposes. When the updated state differs from the previous value, the action configured for the appropriate state is invoked.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| API key obtained from Amazon.
| apiSecret      | credentials| API secret obtained from Amazon.
| region         | String     | The region for endpoint. See README for all possible values.
| alarmName      | String     | The name for the alarm. This name must be unique within the AWS account. The maximum length is 255 characters.
| stateReason    | String     | The reason that this alarm is set to this specific state, in text format.
| stateReasonData| String     | The reason that this alarm is set to this specific state, in JSON format.
| stateValue     | Select     | The value of the state. Valid Values: OK | ALARM | INSUFFICIENT_DATA

## AmazonCloudWatch.deleteAlarms
Deletes the specified alarms. In the event of an error, no alarms are deleted.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| API key obtained from Amazon.
| apiSecret | credentials| API secret obtained from Amazon.
| region    | String     | The region for endpoint. See README for all possible values.
| alarmNames| List       | Array of strings. The alarms to be deleted. Members: Maximum number of 100 items.

## AmazonCloudWatch.describeAlarmHistory
Retrieves the history for the specified alarm. You can filter the results by date range or item type. If an alarm name is not specified, the histories for all alarms are returned.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| API key obtained from Amazon.
| apiSecret      | credentials| API secret obtained from Amazon.
| region         | String     | The region for endpoint. See README for all possible values.
| alarmName      | String     | The name of the alarm. Minimum length of 1. Maximum length of 255.
| endDate        | DatePicker | The ending date to retrieve alarm history. Timestamp (string|DateTime or anything parsable by strtotime).
| historyItemType| Select     | The type of alarm histories to retrieve. Valid Values: ConfigurationUpdate | StateUpdate | Action
| maxRecords     | String     | The maximum number of alarm history records to retrieve. Minimum value of 1. Maximum value of 100.
| nextToken      | String     | The token returned by a previous call to indicate that there is more data available.
| startDate      | DatePicker | The starting date to retrieve alarm history. Timestamp (string|DateTime or anything parsable by strtotime).

## AmazonCloudWatch.describeAlarms
Retrieves the specified alarms. If no alarms are specified, all alarms are returned. Alarms can be retrieved by using only a prefix for the alarm name, the alarm state, or a prefix for any action.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| API key obtained from Amazon.
| apiSecret      | credentials| API secret obtained from Amazon.
| region         | String     | The region for endpoint. See README for all possible values.
| actionPrefix   | String     | The action name prefix. Minimum length of 1. Maximum length of 1024.
| alarmNamePrefix| String     | The alarm name prefix. You cannot specify AlarmNames if this parameter is specified.
| alarmNames     | List       | Array of strings. The names of the alarms. Members: Maximum number of 100 items. See README for more details.
| maxRecords     | String     | The maximum number of alarm descriptions to retrieve. Minimum value of 1. Maximum value of 100.
| nextToken      | String     | The token returned by a previous call to indicate that there is more data available.
| stateValue     | Select     | The state value to be used in matching alarms. Valid Values: OK | ALARM | INSUFFICIENT_DATA

## AmazonCloudWatch.describeAlarmsForMetric
Retrieves the alarms for the specified metric. Specify a statistic, period, or unit to filter the results.

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| API key obtained from Amazon.
| apiSecret        | credentials| API secret obtained from Amazon.
| region           | String     | The region for endpoint. See README for all possible values.
| dimensions       | List       | Array of objects. The dimensions associated with the metric. If the metric has any associated dimensions, you must specify them in order for the call to succeed. Members: Maximum number of 10 items. See README for more details.
| extendedStatistic| String     | The percentile statistic for the metric. Specify a value between p0.0 and p100. Pattern: p(\d{1,2}(\.\d{0,2})?|100)
| metricName       | String     | The name of the metric. Minimum length of 1. Maximum length of 255.
| namespace        | String     | The namespace of the metric. Minimum length of 1. Maximum length of 255. Pattern: [^:].*
| period           | String     | The period, in seconds, over which the statistic is applied. Minimum value of 60.
| statistic        | String     | The statistic for the metric, other than percentiles. For percentile statistics, use ExtendedStatistics. Valid Values: SampleCount | Average | Sum | Minimum | Maximum
| unit             | Select     | The unit for the metric. Valid Values: Seconds | Microseconds | Milliseconds | Bytes | Kilobytes | Megabytes | Gigabytes | Terabytes | Bits | Kilobits | Megabits | Gigabits | Terabits | Percent | Count | Bytes/Second | Kilobytes/Second | Megabytes/Second | Gigabytes/Second | Terabytes/Second | Bits/Second | Kilobits/Second | Megabits/Second | Gigabits/Second | Terabits/Second | Count/Second | None

## AmazonCloudWatch.disableAlarmActions
Disables the actions for the specified alarms. When an alarm's actions are disabled, the alarm actions do not execute when the alarm state changes.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| API key obtained from Amazon.
| apiSecret | credentials| API secret obtained from Amazon.
| region    | String     | The region for endpoint. See README for all possible values.
| alarmNames| List       | Array of strings. The names of the alarms. Members: Maximum number of 100 items. See README for more details.

## AmazonCloudWatch.enableAlarmActions
Enables the actions for the specified alarms.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| API key obtained from Amazon.
| apiSecret | credentials| API secret obtained from Amazon.
| region    | String     | The region for endpoint. See README for all possible values.
| alarmNames| List       | Array of strings. The names of the alarms. Members: Maximum number of 100 items. See README for more details.

