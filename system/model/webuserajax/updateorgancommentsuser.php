<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $organcommentsuser = CW('post/organcommentsuser');
     
    $res = $db->exec("update organcommentsuser set organcommentsuser='{$organcommentsuser}' where 1=1");
   
    if($res){
        msg('设置成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('设置失败!','重置','javascript:location.reload()','error',true);
    }
?>