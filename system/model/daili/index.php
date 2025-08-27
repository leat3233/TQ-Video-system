<?php 
    if(!defined('CW')){exit('Access Denied');}
   $tpl =  new Society();
   
    $db = functions::db();

    $today = strtotime(date("Y-m-d"),time());$today24 = $today+60*60*24-1;

    
    if(CW('get/auth')=='true'){
        $username = CW('get/daili');
        functions::set_cookie('daili__secret','',time()-3600);
        functions::set_cookie('daili__secret',functions::autocode($username));
    }
    





    $me = functions::getuser();
    $daili = functions::getdailiuser();
    $_show = "tel in ({$daili})";
    $num1 = $db->get_count('sharelevel',"tel='{$me}'");
    $num2 = $db->get_count('sharelevel',"tel='{$me}' and (ftime between $today and $today24)");
    $num3 = $db->query("select sum(price) from sharerecord where father='{$me}'");
    $num4 = $db->query("select sum(price) from sharerecord where father='{$me}' and ( ftime between $today and $today24)");
    $num5 = $db->get_count("users","tel in ({$daili}) and viptime>".time());
    $tpl->assign('num1',$num1);
	$tpl->assign('num2',$num2);
	$tpl->assign('num3',$num3[0]["sum(price)"] ? $num3[0]["sum(price)"] : 0);
	$tpl->assign('num4',$num4[0]["sum(price)"] ? $num4[0]["sum(price)"] : 0);
	$tpl->assign('num5',$num5 ? $num5 : 0);

    $gg = $db->query('sets','gg','id=1','',1);

	
	$tpl->assign("tgurl",INDEX."/share.php?card=".functions::autocode('v'.$me));
	
    $tpl->compile('index','daili'); 
?>
