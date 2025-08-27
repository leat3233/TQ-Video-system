<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    
    $sendtime = intval(CW('cookie/sendtime'))+60;
    if($sendtime>time()){
        echo json_encode(array(
            'err'=>'短信发送频率过于频繁, 请稍后再试',
            'state'=>2
        ));return;
    }
    functions::set_cookie('sendtime',time());
    function post($curlPost,$url){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_NOBODY, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
            $return_str = curl_exec($curl);
            curl_close($curl);
            return $return_str;
    }
    function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }
    $db = functions::db();
    $apimessage = $db->query('apimessage','','id=1');
    if(!$apimessage[0]['apiid'] || !$apimessage[0]['apikey']){
        echo json_encode(array(
            'err'=>'短信系统未配置, 请联系管理人员',
            'state'=>2
        ));return;
    }
    //短信接口地址
    $target = "http://106.ihuyi.com/webservice/sms.php?method=Submit";
    //获取手机号
    $mobile = CW('post/telphone',1);

    //获取验证码
    $code = CW('post/code',1);
    
    $apiid = $apimessage[0]['apiid'];
    $apikey = $apimessage[0]['apikey'];
     
    $post_data = "account={$apiid}&password={$apikey}&mobile={$mobile}&content=".rawurlencode("您的验证码是：".$code."。请不要把验证码泄露给其他人。");
    $gets =  xml_to_array(post($post_data, $target));
    if($gets['SubmitResult']['code']==2){
        $_SESSION['mobile'] = $mobile;
        $_SESSION['mobile_code'] = $mobile_code;
    }
    if($gets['SubmitResult']['code']=='2'){
        echo json_encode(array(
            'state'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>$gets['SubmitResult']['msg'].' 错误码: '.$gets['SubmitResult']['code'],
            'state'=>2
        ));
    }
    
?>


