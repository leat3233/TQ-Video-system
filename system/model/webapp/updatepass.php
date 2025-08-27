<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $username = CW('post/username');
    $oldpass = CW('post/oldpass');
    $newpass = CW('post/newpass');
    $newpass2 = CW('post/newpass2');
    if(!$username || !$oldpass || !$newpass || !$newpass2){
        msg('内容必须全部填写!','重填','javascript:location.reload()','',true);
    }
    $db = functions::db();
	$admin = $db->query('admin','','id=1','',1);
	if(!$admin){
		$db->exec('admin','i',array(
			'username'=>'admin',
			'password'=>'admin888',
			'password2'=>'888888',
			'ftime'=>time()
		));
	}
	if($oldpass!=$admin[0]['password']){
		msg('原密码错误!','重填','javascript:location.reload()','error',true);
	}
	
	if(strlen($username)>20 || strlen($username)<1){
    	msg('用户名字符要求为1~20','重填','javascript:location.reload()','error',true);
    }
	if(strlen($newpass)>20 || strlen($newpass)<1){
    	msg('密码字符要求为1~20','重填','javascript:location.reload()','error',true);
    }
	
	// if($oldpass!=$newpass){
	// 	msg('两次密码填写不一致!','重填','javascript:location.reload()','error',true);
	// }
	$res = $db->exec('admin','u',array(array(
		'username'=>$username,
		'password'=>$newpass,
		'password2'=>$newpass2
	),array(
		'id'=>1
	)));
   
    if($res){
        functions::set_cookie('__secret','',time()-3600);
        msg('密码修改成功!','确定',INDEX.'/login.gsp','success');
    }else{
        msg('密码修改失败!','刷新','javascript:location.reload()','error',true);
    }
?>