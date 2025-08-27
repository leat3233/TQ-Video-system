<?php 
    if(!defined('CW')){exit('Access Denied');}

    $db = functions::db();
    $tel = CW('post/tel');
    $user = $db->query('users','diam',"tel='{$tel}'",'',1);
    $data = array();
    $num=0;
    $diamcards = $db->query('diamcard','','','id asc');
    foreach ($diamcards as $diamcard){
        $num++;
        array_push($data,array(
            'id'=>$num,
            'diam'=>$diamcard['diamnum'],
            'descs'=>$diamcard['descs'],
            'price'=>$diamcard['price'],
            'tag'=>$diamcard['tag'] ? $diamcard['tag'] : '优惠'
        ));
    }
  
    echo json_encode(array(
        'diam'=>$user[0]['diam'],
        'data'=>$data,
    ));
    
?>


