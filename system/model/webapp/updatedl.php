<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $tel = CW('post/tel');
    $bili = intval(CW('post/bili'));
    $state = CW('post/state');
    $dailipass = CW('post/dailipass');
    $db = functions::db();
    
    
    $id = CW('post/id');
    if(!$id){
        msg('ID不存在!','重置','javascript:location.reload()','error',true);
    }
    $exist = $db->query('users','',"tel!='' and tel='{$tel}'",'',1);
    if(!$exist){
        msg('用户不存在,请重新填写!','重置','javascript:location.reload()','error',true);
    }
    if($bili>100 || $bili<1){
        msg('需填写1-100内的整数!','重置','javascript:location.reload()','error',true);
    }
    $res = $db->exec('dluser','u',array(array(
        'tel'=>$tel,
    	'bili'=>$bili,
    	"state"=>$state,
    	'dailipass'=>$dailipass
    ),array(
        'id'=>$id
    )));
    if($res){
        msg('更新成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('数据无变动!','重置','javascript:location.reload()','error',true);
    }
?>