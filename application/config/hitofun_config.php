<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//OBO尋房旅館間數最小值
$config['MIN_OBO_SIZE'] = 4;
//OBO入住及退房時間
$config['OBO_CHECK_IN_TIME'] = '15:00';
$config['OBO_CHECK_OUT_TIME'] = '11:00';
//稅率
$config['TAX_RATE'] = 0.05;
$config['FEES'] = 0;
//OBO價格保護倍率
$config['OBO_PROTECTION_RATIO'] = 1.8;
//OBO尋房時限
$config['OBO_REQUIRE_TIME'] = 6;
//OBO長期合約commission
$config['LONG_TERM_CONTRACT_COMMISSION'] = 0.15;
//OBO一次性合約commission
$config['ONE_TIME_CONTRACT_COMMISSION'] = 0.25;
//經銷商commission
$config['DEALER_COMMISSION'] = 0.05;
//長期合約type
$config['LONG_TERM_CONTRACT_TYPE'] = 1;
//一次性合約type
$config['ONE_TIME_CONTRACT_TYPE'] = 2;
//週末obo倍率
$config['WEEKEND_OBO_RATIO'] = 0.2;
//搜尋半徑
$config['SEARCH_RADIUS'] = 1000;
//搜尋半徑擴大距離
$config['SEARCH_RADIUS_EXPAND'] = 500;
//最大搜尋半徑
$config['MAX_SEARCH_RADIUS'] = 10000;
//最少搜尋旅館家數
$config['MIN_OBO_SEARCH_SIZE'] = 40;
//最多搜尋旅館家數
$config['MAX_OBO_SEARCH_SIZE'] = 150;

/* End of file hitofun_config.php */