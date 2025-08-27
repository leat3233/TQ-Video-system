<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $id = CW('post/id');
    
    $tuan = $db->query('tuan','',"id='{$id}'",'',1);
    
    $isbuy = $db->query('buyrecord','',"tel='{$tel}' and payid='{$id}' and paytype='tuan'",'',1);
    $viptime = $db->query('users','viptime',"tel='{$tel}'",'',1);
    if($viptime[0]['viptime']>time()){
        $isbuy = true;
    }
    $diamcharge = $db->query('sets','diamcharge','id=1','',1);
    $imglists = explode('|',$tuan[0]['imglist']);
    $imglist = array();
    foreach ($imglists as $img){
        array_push($imglist,$img);
    }
    echo json_encode(array(
        'data'=>$tuan,
        'desc'=>$db->query('users','descs',"tel='{$tuan[0]['tel']}'",'',1)[0]['descs'],
        'isbuy'=>$isbuy ? true : false,
        'price'=>$diamcharge[0]['diamcharge'],
        'imglist'=>$imglist,
        'avatar'=>$db->query('users','avatar',"tel='{$tuan[0]['tel']}'",'',1)[0]['avatar'],
    ));

?>