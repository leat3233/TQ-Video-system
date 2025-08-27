<?php
/* *
 * 功能：彩虹易支付异步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */
require("../config.inc.php");
require("../system/runtime.php");

require_once("lib/epay.config.php");
require_once("lib/EpayCore.class.php");

//http://104.192.87.250/pay/notify_url.php?pid=1033&trade_no=2024052617100493724&out_trade_no=20240526171031146&type=0&name=product&money=100&trade_status=TRADE_SUCCESS&sign=abaa5cb9a34c4779a1dc60ecc7c725bb&sign_type=MD5

	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];
	//彩虹易支付交易号
	$trade_no = $_GET['trade_no'];
	//支付方式
	$type = $_GET['type'];
	//支付金额
	$money = $_GET['money'];
	if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
	    $db = functions::db();
		$res = $db->exec("update pays set mchorderno='{$trade_no}',state=1 where payorder='{$out_trade_no}'");
		if($res){
		    $test = $db->query('pays','paytype',"payorder='{$out_trade_no}'");
		    $test = $test[0]['paytype'];
            $tel = substr($test,0,strrpos($test,'|'));
        	$type = substr($test,strripos($test,'-')+1);
        	$id =substr($test,strrpos($test,'|')+1);
        	$id =substr($id,0,strrpos($id,'-'));
        	functions::pay($tel,$id,$type);
        	
        	$father = $db->query('sharelevel','tel',"tel2='{$tel}'",'',1);
        	if($father[0]['tel']){
        	    functions::fenrun($father[0]['tel'],$tel);
        	}
        	
        	
		}
		//验证成功返回
	    echo "success";
	}else{
	    echo "fail";
	}


?>