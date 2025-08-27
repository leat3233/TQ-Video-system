<?php
/* *
 * 配置文件
 */

require_once("../config.inc.php");
require_once("../system/runtime.php");
//支付接口地址

$db = functions::db();
$set = $db->query('sets','mn1,mn2,mn3','id=1')[0];

$epay_config['apiurl'] = $set['mn1'];

//商户ID
$epay_config['pid'] = $set['mn2'];

//商户密钥
$epay_config['key'] = $set['mn3'];
