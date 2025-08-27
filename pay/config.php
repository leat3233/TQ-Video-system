<?php
require("../config.inc.php");
require("../system/runtime.php");




$db = functions::db();
$fangan = functions::get('sets','fangan');
if($fangan=='支付方案一'){
    require_once("lib/EpayCore.class.php");
    require_once("lib/epay.config.php");
    $id = CW('get/id',1);
    $paytype = CW('get/paytype');
    if($paytype=='wx'){
        $paytype= "wxpay";
    }
    $type = CW('get/type');//vip
    $user = CW('get/uid');
    
    $exist = $db->query('users','',"user='{$user}'",'',1);
    if(!$exist){
        exit('用户不存在');
    }
    if($type=='vip'){
        $price = $db->query('vipcard','',"id='{$id}'")[0];
    }else{
        $price = $db->query('diamcard','',"id='{$id}'")[0];
    }
    $price = $price['price'];
    
    $num = date("YmdHis").mt_rand(100,999);
    $parameter = array(
    	"pid" => $epay_config['pid'],
    	"type" => $paytype,
    	"notify_url" => INDEX.'/pay/notifyUrl.php',
    	"return_url" => INDEX.'/pay/backUrl.php',
    	"out_trade_no" =>$num,
    	"name" => 'pay',
    	"money"	=> $price,
    	'ftime'=>time()
    );
    $res = $db->exec('pays','i',array(
        'user'=>$user,
        'price'=>$price,
        'paytype'=>$type.'-'.$id,
        'userorder'=>$num,
        'systemorder'=>'',
    ));
    if($res){
        $epay = new EpayCore($epay_config);
    $html_text = $epay->pagePay($parameter);
    echo $html_text;
    }else{
        echo "交易建立失败";
    }
}else if($fangan=='支付方案二'){
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $id = CW('get/id',1);
    $paytype = CW('get/paytype')=='alipay' ? 1 : 2;
    $type = CW('get/type');//vip
    $user = CW('get/uid');
    
    $exist = $db->query('users','',"user='{$user}'",'',1);
    if(!$exist){
        exit('用户不存在');
    }
    if($type=='vip'){
        $price = $db->query('vipcard','',"id='{$id}'")[0];
    }else{
        $price = $db->query('diamcard','',"id='{$id}'")[0];
    }
    
    
    $price = $price['price'];
    // 发起http请求
    $url = 'https://cjwg.yvzf.xyz/api/pay/create_order';
    $userorder = date("YmdHis").mt_rand(10000,99999);
    $requestarray = array(
        "mchId" =>20000040,
        "productId" => 707,
        "mchOrderNo" =>$userorder,
        "amount" => 100,
        "clientIp"=>'0.0.0.0',
        "device"=>'ios10.3.1',
        "returnUrl"=>INDEX.'/pay/backUrl.php',
        "notifyUrl"=>INDEX.'/pay/notifyUrl.php',
        "subject"=>'pay',
        'body'=>'pay',
        'param1'=>'',
        'param2'=>'',
        'extra'=>''
    );
    $requestarray['sign'] = sign($requestarray, '8PLC72RQJZAKIOH9SOAG2GTMIY4CW4UGXOERREVLGFWMKPSFJ3BQSCKLWVRJGHQPZTFYYGZSY2O8LWUBX4GVIK0NOCTEOTE7US3GD6AAWR9MDKKLDYBLNM8DOQR3ETAH');   // MD5 签名
    
     
  $val = getHttpContent($url,"GET",$requestarray);
    

    if($res['h5_url']){
        
        $db->exec('pays','i',array(
            'user'=>$user,
            'price'=>$price,
            'paytype'=>$type.'-'.$id,
            'userorder'=>$userorder,
            'systemorder'=>'',
            'ftime'=>time()
        ));
        functions::url($res['h5_url']);
        
    }else{
        exit('支付失败');
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
    function sign($requestarray = [], $secret = ''){
        ksort($requestarray); 
        $md5str = "";
        foreach ($requestarray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $secret));
        return $sign;
    }
    function getHttpContent($url, $method = 'GET', $postData = array()) {
        $data = '';
        $user_agent = $_SERVER ['HTTP_USER_AGENT'];
        $header = array(
            "User-Agent: $user_agent"
        );
        if (!empty($url)) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30); //30秒超时
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
                if (strtoupper($method) == 'POST') {
                    $curlPost = is_array($postData) ? http_build_query($postData) : $postData;
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
                }
                $data = curl_exec($ch);
                curl_close($ch);
            } catch (Exception $e) {
                $data = '';
            }
        }
        return $data;
    }
    
?>