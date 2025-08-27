<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $set = $db->query('sets','','id=1');
    if(!$set){
        $db->exec('sets','i',array(
            "ment1"=>'公告未设置',
            "ment2"=>'公告未设置',
            "look"=>10,
            "greenhorn"=>1,
            "customer"=>1,
            "pay"=>200,
            "onlyvip"=>1,
            "r1"=>0.65,
            "r2"=>0.1,
            "r3"=>0.05,
            "p1"=>0,
            "p2"=>5000,
            "p3"=>5001,
            "p4"=>30000,
            "p5"=>30001,
            "f1"=>0.45,
            "f2"=>0.55,
            "f3"=>0.7,
            "nickname"=>"安琪拉|大乔|孙尚香"
        ));
        $set = $db->query('sets','','id=1');
    }
    $tpl =  new Society();
    $tpl->assign('nickname',$set[0]['nickname']);
    $tpl->assign('desces',$set[0]['desces']);
    $tpl->compile('userset','admin'); 
?>