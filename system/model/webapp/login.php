<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $username = CW('post/username',3);
    $password = CW('post/password',3);
    $password2 = CW('post/password2',3);
    //$code = CW('post/code');
   
    if(!$username || !$password || !$password2){
        msg('内容必须全部填写!','重填','javascript:location.reload()','',true);
    }
    $cookie_code = functions::autocode(CW('cookie/code'),'-');
	if($code!=$cookie_code){
		//msg('验证码填写错误!','重填','javascript:location.reload()','',true);
	}
	$db = functions::db();
	$admin = $db->query('admin','','id=1','',1);

	if(($username==$admin[0]['username'] && $password==$admin[0]['password'] && $password2==$admin[0]['password2'])){
    	functions::set_cookie('__secret',functions::autocode('islogin'));
    	//$ip = functions::get_real_ip();
    	//$address = functions::get_user_city($ip);
    	//$address = $address ? $address : '未知';
    	$db->exec('admin','u',array(array(
    		'logtime'=>time(),
    		'ip'=>'',
    		'address'=>''
    	),array(
    		'id'=>1
    	)));
        msg('验证通过!','确定',INDEX.'/admin.php?mod=index','success');
    }else{
        msg('验证失败!','重试','javascript:location.reload()','error',true);
    }
?>