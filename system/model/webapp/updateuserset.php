<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $nickname = CW('post/nickname');
    $desces = CW('post/desces');
    if(strlen($desces)>255){
        msg('用户默认个性签名不得超过255个字符!','确定','','');
    }
    

    
    $res = $db->exec('sets','u',array(
        array(
            "nickname"=>$nickname,
            "desces"=>$desces,
        ),array(
            "id"=>1
        )));
   
    if($res){
    	msg('设置成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>