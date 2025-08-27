<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $db = functions::db();
    $pay = $db->query('pay','','id=1','',1);
    if(!$pay){
        $db->exec('pay','i',array(
            'pay1'=>'关闭'    
        ));$pay = $db->query('pay','','id=1','',1);
    }
    $tpl->assign('pay1',$pay[0]['pay1']);
    $tpl->assign('pay2',$pay[0]['pay2']);
    $tpl->assign('pay3',$pay[0]['pay3']);
    $tpl->assign('pay4',$pay[0]['pay4']);
    $tpl->assign('pay5',$pay[0]['pay5']);
    $tpl->assign('pay6',$pay[0]['pay6']);
    $tpl->assign('pay7',$pay[0]['pay7']);
    $tpl->assign('pay8',$pay[0]['pay8']);
    $tpl->assign('pay9',$pay[0]['pay9']);
    $tpl->assign('pay10',$pay[0]['pay10']);
    $tpl->assign('pay11',$pay[0]['pay11']);
    $tpl->assign('pay12',$pay[0]['pay12']);
    $tpl->assign('pay13',$pay[0]['pay13']);
    $tpl->assign('pay14',$pay[0]['pay14']);
    $tpl->assign('pay15',$pay[0]['pay15']);
    $tpl->compile('pay','admin');//
?>