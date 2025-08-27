<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $user = $db->query('organcommentsuser','organcommentsuser','','id asc',1);
    if(!$user){
        $res = $db->exec('organcommentsuser','i',array(
            'organcommentsuser'=>'0'    
        ));
        if($res){
            $user = $db->query('organcommentsuser','organcommentsuser','','id asc',1);
        }
    }
    $tpl =  new Society();
    $tpl->assign('organcommentsuser',$user[0]['organcommentsuser']);
    $tpl->compile('wechatcomments','admin'); 
?>