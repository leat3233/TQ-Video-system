<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $pak1 = CW('post/pak1');
    $pak2 = CW('post/pak2');
    $pak3 = CW('post/pak3');
    $pak4 = CW('post/pak4');
    $pak5 = CW('post/pak5');
    $pak6 = CW('post/pak6');
    $pak7 = CW('post/pak7');
    if(!$pak1 || !$pak2 || !$pak3 || !$pak4 || !$pak5 || !$pak6 || !$pak7){
        msg('每项必填!','重填','javascript:location.reload()','',true);
    }
    if(!strstr($pak1,'/') || !strstr($pak2,'/') || !strstr($pak3,'/') || !strstr($pak4,'/') || !strstr($pak5,'/') || !strstr($pak6,'/') || !strstr($pak7,'/')){
        msg('标题填写错误, 请按提示重新填写!','重填','javascript:location.reload()','',true);
    }
    $db = functions::db();
	$res = $db->exec('recommend','u',array(array(
		'pak1'=>$pak1,
		'pak2'=>$pak2,
		'pak3'=>$pak3,
		'pak4'=>$pak4,
		'pak5'=>$pak5,
		'pak6'=>$pak6,
		'pak7'=>$pak7,
	),array(
		'id'=>1
	)));
   
    if($res){
        msg('设置成功!','确定','','success');
    }else{
        msg('设置失败!','刷新','javascript:location.reload()','error',true);
    }
?>