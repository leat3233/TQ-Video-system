<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $tel = CW('post/tel',1);
    $exist = $db->query('users','',"tel='{$tel}'",'id asc',1);
    if($exist){
        echo json_encode(array(
            'state'=>0,
            'err'=>'该手机号已被注册!'
        ));return;
    }
    
    $code = CW('post/card',3);
    if(!$tel){
        echo json_encode(array(
            'state'=>0,
            'err'=>'请填写电话号码!'
        ));return;
    }
    if(!preg_match("/^1[34578]{1}\d{9}$/",$tel)){
        echo json_encode(array(
            'state'=>0,
            'err'=>'电话号码格式错误!'
        ));return;
    }
    $isexist = false;
	$card = '';
	do {
		$card = chr(rand(97,122)).mt_rand(100000000,999999999);
		$isexist = $db->query('users','id',"card='{$card}'");
	} while ($isexist);
    $user = $db->query('sets','desces,nickname','id=1');
    $array = explode('|',$user[0]['nickname']);
    $nickname = $array[array_rand($array,1)];
    $avatar = '../../image/avatar/icon_avatar_'.mt_rand(1,17).'.png';
    $descs = $user[0]['desces'];
    $time = time();
    $res = $db->exec('users','i',array(
        'nickname'=>$nickname,
        'tel'=>$tel,
        'avatar'=>$avatar,
        'card'=>$card,
        'descs'=>$descs,
        'ftime'=>$time,
    ));
    if($res){
        $append = '';
        if($code){
            $prevtel = $db->query('users','tel',"card='{$code}'",'',1);
            $prevtel = $prevtel[0]['tel'];
            if($prevtel){
                functions::intobroker($prevtel,$tel,$time);
            }else{
                $append = ", 推荐码拥有者未绑定手机。绑定后, 您可进入APP在 我的-设置-绑定邀请码 里重新绑定";
            }
            
        }
        echo json_encode(array(
            'state'=>1,
            'data'=>'注册成功'.$append
        ));
    }else{
        echo json_encode(array(
            'state'=>0,
            'err'=>'注册失败,请稍后再试!'
        ));
    }
?>