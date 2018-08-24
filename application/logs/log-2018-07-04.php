<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-07-04 17:34:56 --> Query error: Column 'orderId' in where clause is ambiguous - Invalid query: SELECT `obo_refund`.*, `member`.`memberAccount` AS `memberAccount`, `member`.`memberFirstName` AS `memberFirstName`, `member`.`memberLastName` AS `memberLastName`, `order`.`orderSerial` AS `orderSerial`, `order`.`orderGrandTotal` AS `orderGrandTotal`
FROM `obo_refund`
INNER JOIN `member` ON `obo_refund`.`memberId` = `member`.`memberId`
INNER JOIN `order` ON `obo_refund`.`orderId` = `order`.`orderId`
WHERE `orderId` = '7410'
ORDER BY `oboRefundId` DESC
ERROR - 2018-07-04 17:37:33 --> Query error: Column 'orderId' in where clause is ambiguous - Invalid query: SELECT `obo_refund`.*, `member`.`memberAccount` AS `memberAccount`, `member`.`memberFirstName` AS `memberFirstName`, `member`.`memberLastName` AS `memberLastName`, `order`.`orderSerial` AS `orderSerial`, `order`.`orderGrandTotal` AS `orderGrandTotal`
FROM `obo_refund`
INNER JOIN `member` ON `obo_refund`.`memberId` = `member`.`memberId`
INNER JOIN `order` ON `obo_refund`.`orderId` = `order`.`orderId`
WHERE `orderId` = '7410'
ORDER BY `oboRefundId` DESC
ERROR - 2018-07-04 11:41:47 --> 404 Page Not Found: oboAdmin/OboRefund/edit
ERROR - 2018-07-04 11:53:09 --> 404 Page Not Found: oboAdmin/OboRefund/edit
ERROR - 2018-07-04 11:55:40 --> 404 Page Not Found: oboAdmin/OboRefund/edit
ERROR - 2018-07-04 11:56:09 --> 404 Page Not Found: oboAdmin/OboRefund/edit
