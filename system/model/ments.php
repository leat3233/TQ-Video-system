<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $db = functions::db();
    $sets = $db->query('sets','ment1,ment2','id=1','id asc',1);
    $ment1 = $sets[0]['ment1'];
    $ment2 = $sets[0]['ment2'];
    $hours = date('H',time());
    if($hours>=6 && $hours<=18){
	  $ment = $sets[0]['ment1'];
	}else{
	  $ment = $sets[0]['ment2'];
	}
    $tpl->assign('ment',$ment);
    $tpl->compile('ment',''); 
?>