<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $tel = CW('post/tel');
    $bili = intval(CW('post/bili'));
    $state = CW('post/state');
    $dailipass = CW('post/dailipass');
    $db = functions::db();
    $exist = $db->query('users','',"tel!='' and tel='{$tel}'",'',1);
    if(!$exist){
        msg('用户不存在,请重新填写!','重置','javascript:location.reload()','error',true);
    }
    if($bili>100 || $bili<1){
        msg('需填写1-100内的整数!','重置','javascript:location.reload()','error',true);
    }
    $res = $db->exec('dluser','i',array(
    	'tel'=>$tel,
    	'bili'=>$bili,
    	"state"=>$state,
    	'dailipass'=>$dailipass
    ));
    if($res){
        $url = INDEX."/uplivepopo.php?mod=login";
        msg("开线成功!代理登录地址: {$url}",'刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>