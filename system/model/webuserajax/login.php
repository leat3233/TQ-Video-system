<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $username = CW('post/username',3);
    $password = CW('post/password',3);

    //$code = CW('post/code');
   
    if(!$username || !$password){
        msg('内容必须全部填写!','重填','javascript:location.reload()','',true);
    }
    $cookie_code = functions::autocode(CW('cookie/code'),'-');
	if($code!=$cookie_code){
		//msg('验证码填写错误!','重填','javascript:location.reload()','',true);
	}
	$db = functions::db();
	$admin = $db->query('dluser','',"tel='{$username}' and dailipass='{$password}'",'',1);

	if(($username==$admin[0]['tel'] && $password==$admin[0]['dailipass'])){
    	functions::set_cookie('daili__secret',functions::autocode($username));
    	
    
        msg('验证通过!','确定',INDEX.'/uplivepopo.php?mod=index','success');
    }else{
        msg('账号密码错误或账号未开通代理权限!','重试','javascript:location.reload()','error',true);
    }
?>