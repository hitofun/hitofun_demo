<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-01-30 16:32:26 --> Query error: Unknown column 'orderId' in 'where clause' - Invalid query: SELECT *
FROM `obo_rolling_day`
WHERE `orderId` = '6333'
AND `hasSend` = 'N'
ORDER BY `price` ASC
ERROR - 2018-01-30 16:33:20 --> Error executing "Publish" on "http://sns.us-west-2.amazonaws.com"; AWS HTTP error: Client error: `POST http://sns.us-west-2.amazonaws.com` resulted in a `400 Bad Request` response:
<ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDis (truncated...)
 EndpointDisabled (client): Endpoint is disabled - <ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDisabled</Code>
    <Message>Endpoint is disabled</Message>
  </Error>
  <RequestId>ead10818-5e53-5b71-8af5-5af271862e80</RequestId>
</ErrorResponse>

ERROR - 2018-01-30 16:52:05 --> Error executing "Publish" on "http://sns.us-west-2.amazonaws.com"; AWS HTTP error: Client error: `POST http://sns.us-west-2.amazonaws.com` resulted in a `400 Bad Request` response:
<ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDis (truncated...)
 EndpointDisabled (client): Endpoint is disabled - <ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDisabled</Code>
    <Message>Endpoint is disabled</Message>
  </Error>
  <RequestId>83c440b1-09a2-5a67-acb5-125b3d98b11f</RequestId>
</ErrorResponse>

ERROR - 2018-01-30 16:54:40 --> Error executing "Publish" on "http://sns.us-west-2.amazonaws.com"; AWS HTTP error: Client error: `POST http://sns.us-west-2.amazonaws.com` resulted in a `400 Bad Request` response:
<ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDis (truncated...)
 EndpointDisabled (client): Endpoint is disabled - <ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDisabled</Code>
    <Message>Endpoint is disabled</Message>
  </Error>
  <RequestId>9f964925-766c-5821-a7b4-1bcf42b989d0</RequestId>
</ErrorResponse>

ERROR - 2018-01-30 16:55:20 --> Error executing "Publish" on "http://sns.us-west-2.amazonaws.com"; AWS HTTP error: Client error: `POST http://sns.us-west-2.amazonaws.com` resulted in a `400 Bad Request` response:
<ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDis (truncated...)
 EndpointDisabled (client): Endpoint is disabled - <ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDisabled</Code>
    <Message>Endpoint is disabled</Message>
  </Error>
  <RequestId>38380549-f627-51bd-98c1-57a3c2dae28f</RequestId>
</ErrorResponse>

ERROR - 2018-01-30 16:57:49 --> Error executing "Publish" on "http://sns.us-west-2.amazonaws.com"; AWS HTTP error: Client error: `POST http://sns.us-west-2.amazonaws.com` resulted in a `400 Bad Request` response:
<ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDis (truncated...)
 EndpointDisabled (client): Endpoint is disabled - <ErrorResponse xmlns="http://sns.amazonaws.com/doc/2010-03-31/">
  <Error>
    <Type>Sender</Type>
    <Code>EndpointDisabled</Code>
    <Message>Endpoint is disabled</Message>
  </Error>
  <RequestId>8439728e-9084-55f3-845a-2064a516b3c6</RequestId>
</ErrorResponse>

ERROR - 2018-01-30 17:00:43 --> Query error: Column 'orderRoom' cannot be null - Invalid query: INSERT INTO `order` (`orderSerial`, `memberId`, `orderCheckInName`, `orderCheckInPhone`, `orderCheckInDate`, `orderCheckOutDate`, `orderRoom`, `orderPeople`, `orderOboPrice`, `orderOboLandmarkId`, `orderOboSearchRadius`, `orderFilterMinPrice`, `orderFilterMaxPrice`, `orderType`, `orderStatus`, `orderFees`, `orderTax`, `orderTotal`, `orderGrandTotal`, `createTime`, `isTraining`) VALUES ('TWAA01180000hq', '7', '測試人', '0912888999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 0, 0, 0, 0, '2018-01-30 17:00:43', 'Y')
ERROR - 2018-01-30 17:02:05 --> Severity: Error --> Call to undefined function result() /Applications/XAMPP/xamppfiles/htdocs/hitofun/application/controllers/OBO.php 573
