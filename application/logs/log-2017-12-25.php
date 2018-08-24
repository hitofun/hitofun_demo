<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-12-25 09:18:46 --> Query error: View 'hitofun.last_minute_room_view' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them - Invalid query: SELECT *, COUNT(lastMinutePolicyId) as salesRoomCount
FROM `last_minute_room_view`
WHERE `startTime` <= '2017-12-25 09:18:46'
AND `endTime` >= '2017-12-25 09:18:46'
GROUP BY `lastMinutePolicyId`, `hotelRoomId`, `createTime`
ORDER BY `lastMinuteRoomId` DESC
