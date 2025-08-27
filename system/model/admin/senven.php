<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $apimessage = $db->query('apimessage','','id=1');
    if(!$apimessage){
        $db->exec('apimessage','i',array(
            'apiid'=>'',
            'apikey'=>''
        ));
        $apimessage = $db->query('apimessage','','id=1');
    }
    $tpl =  new Society();
    $tpl->assign('apiid',$apimessage[0]['apiid']);
    $tpl->assign('apikey',$apimessage[0]['apikey']);
    $tpl->assign('accesskey',$apimessage[0]['accesskey']);
    $tpl->assign('secretkey',$apimessage[0]['secretkey']);
    $tpl->assign('url',$apimessage[0]['url']);
    $tpl->assign('spacename',$apimessage[0]['spacename']);
    $tpl->assign('ishow',$apimessage[0]['ishow']);

    
    $tpl->compile('senven','admin'); 
?>