<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $vipcardid = CW('post/vipcardid');
    if(!$vipcardid){
    	msg('ID错误,请重新登录','确定','javascript:location.reload()','error');
    }
    $stit = CW('post/stit');
    $btit = CW('post/btit');
    $oldprice = CW('post/oldprice');
    $nowprice = CW('post/nowprice');
    $descs = CW('post/descs');
    $adddiam = CW('post/adddiam');
    $days = CW('post/days');
    $db = functions::db();
    if(strlen($stit)>24 || strlen($stit)<6){
    	msg('左上角宣传语字符要求为6-24个字符,最多8个汉字','刷新','javascript:location.reload()','',true);
    }
    if(strlen($btit)>18 || strlen($btit)<6){
    	msg('会员卡名称字符要求为6-18个字符,最多6个汉字','刷新','javascript:location.reload()','',true);
    }
    if(strlen($descs)>36 || strlen($descs)<6){
    	msg('描述字符要求为6-36个字符,最多12个汉字','刷新','javascript:location.reload()','',true);
    }
    
    $res = $db->exec('vipcard','u',array(
        array(
            "stit"=>$stit,
            "btit"=>$btit,
            "oldprice"=>$oldprice,
            "nowprice"=>$nowprice,
            "descs"=>$descs,
            "adddiam"=>intval($adddiam),
            "days"=>intval($days),
        ),array(
            "id"=>$vipcardid
        )));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>