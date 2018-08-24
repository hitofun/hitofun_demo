<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-03-26 16:32:52 --> Query error: Unknown column 'member.meberId' in 'group statement' - Invalid query: SELECT `member`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `member`
INNER JOIN `rebate_record` ON `member`.`memberId` = `rebate_record`.`memberId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `member`.`meberId`
ORDER BY `member`.`memberId` DESC
ERROR - 2018-03-26 16:58:18 --> Query error: Unknown column 'member.meberId' in 'group statement' - Invalid query: SELECT `member`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `member`
INNER JOIN `rebate_record` ON `member`.`memberId` = `rebate_record`.`memberId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `member`.`meberId`
ORDER BY `totalAmount` DESC
 LIMIT 10
ERROR - 2018-03-26 16:58:39 --> Query error: Unknown column 'member.meberId' in 'group statement' - Invalid query: SELECT `member`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `member`
INNER JOIN `rebate_record` ON `member`.`memberId` = `rebate_record`.`memberId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `member`.`meberId`
ORDER BY `totalAmount` DESC
 LIMIT 10, 10
ERROR - 2018-03-26 16:58:52 --> Query error: Unknown column 'member.meberId' in 'group statement' - Invalid query: SELECT `member`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `member`
INNER JOIN `rebate_record` ON `member`.`memberId` = `rebate_record`.`memberId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `member`.`meberId`
ORDER BY `totalAmount` DESC
 LIMIT 1, 10
ERROR - 2018-03-26 16:58:56 --> Query error: Unknown column 'member.meberId' in 'group statement' - Invalid query: SELECT `member`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `member`
INNER JOIN `rebate_record` ON `member`.`memberId` = `rebate_record`.`memberId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `member`.`meberId`
ORDER BY `totalAmount` DESC
 LIMIT 10
ERROR - 2018-03-26 17:01:37 --> Query error: Unknown column 'member.memberId' in 'order clause' - Invalid query: SELECT `hotel`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `hotel`
INNER JOIN `rebate_record` ON `hotel`.`hotelId` = `rebate_record`.`hotelId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `hotel`.`hotelId`
ORDER BY `totalAmount` DESC, `member`.`memberId` DESC
 LIMIT 10
ERROR - 2018-03-26 17:02:39 --> Query error: Unknown column 'member.memberId' in 'order clause' - Invalid query: SELECT `hotel`.*, SUM(`rebate_record`.`amount`) AS `totalAmount`
FROM `hotel`
INNER JOIN `rebate_record` ON `hotel`.`hotelId` = `rebate_record`.`hotelId`
WHERE `rebate_record`.`isReceive` != 'Y'
GROUP BY `hotel`.`hotelId`
ORDER BY `totalAmount` DESC, `member`.`memberId` DESC
 LIMIT 10
