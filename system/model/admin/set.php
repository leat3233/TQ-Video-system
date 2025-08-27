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
            "pay"=>100,
            "withdrawals"=>200,
            "onlyvip"=>1,
            "vipcomments"=>1,
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
            "diamcharge"=>5,
            'vertype'=>''
        ));
        $set = $db->query('sets','','id=1');
    }
    $tpl =  new Society();
   
    $tpl->assign('p1',$set[0]['p1']);
    $tpl->assign('p2',$set[0]['p2']);
    $tpl->assign('p3',$set[0]['p3']);
    $tpl->assign('p4',$set[0]['p4']);
    $tpl->assign('p5',$set[0]['p5']);
    $tpl->assign('f1',$set[0]['f1']);
    $tpl->assign('f2',$set[0]['f2']);
    $tpl->assign('f3',$set[0]['f3']);
    $tpl->assign('scaletype',$set[0]['scaletype']);
    $tpl->assign('look',$set[0]['look']);
    $tpl->assign('greenhorn',$set[0]['greenhorn']);
    $tpl->assign('customer',$set[0]['customer']);
    $tpl->assign('pay',$set[0]['pay']);
    $tpl->assign('withdrawals',$set[0]['withdrawals']);
    $tpl->assign('onlyvip',$set[0]['onlyvip']);
    $tpl->assign('vipcomments',$set[0]['vipcomments']);
    $tpl->assign('r1',$set[0]['r1']);
    $tpl->assign('r2',$set[0]['r2']);
    $tpl->assign('r3',$set[0]['r3']);
    
    $tpl->assign('adda',$set[0]['adda']);
    $tpl->assign('addb',$set[0]['addb']);
    
    $tpl->assign('start1',$set[0]['start1']);
    $tpl->assign('start2',$set[0]['start2']);
    
    $tpl->assign('b2',$set[0]['b2']);
    $tpl->assign('b3',$set[0]['b3']);
    $tpl->assign('b4',$set[0]['b4']);
    $tpl->assign('b5',$set[0]['b5']);
    $tpl->assign('b6',$set[0]['b6']);
    $tpl->assign('bbb',$set[0]['bbb']);
    
    $tpl->assign('k1',$set[0]['k1']);
    $tpl->assign('k2',$set[0]['k2']);
    $tpl->assign('k3',$set[0]['k3']);
    $tpl->assign('k4',$set[0]['k4']);
    $tpl->assign('k5',$set[0]['k5']);
    $tpl->assign('k6',$set[0]['k6']);
    $tpl->assign('bili',$set[0]['bili']);
    $tpl->assign('suiji',$set[0]['suiji']);
    $tpl->assign('h5',$set[0]['h5']);
    
    $tpl->assign('h51',$set[0]['h51']);
    $tpl->assign('h52',$set[0]['h52']);
    $tpl->assign('h53',$set[0]['h53']);
    $tpl->assign('h54',$set[0]['h54']);
    
    
    $tpl->assign('h511',$set[0]['h511']);
    $tpl->assign('h522',$set[0]['h522']);
    $tpl->assign('h533',$set[0]['h533']);
    $tpl->assign('h544',$set[0]['h544']);
    $tpl->assign('luedi',$set[0]['luedi']);
    
    $tpl->assign('tanchuang',$set[0]['tanchuang']);
    $tpl->assign('tanchuang1',$set[0]['tanchuang1']);
    $tpl->assign('tanchuang2',$set[0]['tanchuang2']);
    
    $tpl->assign('changnum',$set[0]['changnum']);
    $tpl->assign('duannum',$set[0]['duannum']);
    
    $tpl->assign('mn1',$set[0]['mn1']);
    $tpl->assign('mn2',$set[0]['mn2']);
    $tpl->assign('mn3',$set[0]['mn3']);
    
    $tpl->assign('oo1',$set[0]['oo1']);
    $tpl->assign('oo2',$set[0]['oo2']);
    $tpl->assign('oo3',$set[0]['oo3']);
    $tpl->assign('banben',$set[0]['banben']);$tpl->assign('kefu',$set[0]['kefu']);
    
    $tpl->assign('logo',$set[0]['logo']);
    $tpl->assign('geturl',$set[0]['geturl']);
    $tpl->assign('diamcharge',$set[0]['diamcharge']);
    $tpl->assign('inviteuser1',$set[0]['inviteuser1']);$tpl->assign('inviteuser2',$set[0]['inviteuser2']);
    $tpl->assign('inviteuser3',$set[0]['inviteuser3']);$tpl->assign('inviteuser4',$set[0]['inviteuser4']);
    $tpl->assign('inviteday1',$set[0]['inviteday1']);$tpl->assign('inviteday2',$set[0]['inviteday2']);
    $tpl->assign('inviteday3',$set[0]['inviteday3']);$tpl->assign('inviteday4',$set[0]['inviteday4']);
    $tpl->compile('set','admin'); 
?>