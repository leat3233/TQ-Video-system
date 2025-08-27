<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $tel = CW('post/tel');
    $newpass2 = CW('post/newpass2',3);
    $newpass = CW('post/newpass',3);
    
    if($newpass2!=$newpass){
        msg('两次密码输入不一致!','重填','javascript:location.reload()','error',true);
    }
    if(!$newpass2 || !$newpass){
        msg('内容必须全部填写!','重填','javascript:location.reload()','',true);
    }
    $db = functions::db();
	
	if(strlen($newpass)>20 || strlen($newpass)<1){
    	msg('密码字符要求为1~20','重填','javascript:location.reload()','error',true);
    }
	
    $res = $db->exec("update dluser set dailipass='{$newpass}' where tel='{$tel}'");

   
    if($res){
        functions::set_cookie('daili__secret','',time()-3600);
        msg('密码修改成功!新密码是:'.$newpass,'确定',INDEX.'/uplivepopo.php?mod=login','success');
    }else{
        msg('密码修改失败且新密码不能和原密码相同!','刷新','javascript:location.reload()','error',true);
    }
?>