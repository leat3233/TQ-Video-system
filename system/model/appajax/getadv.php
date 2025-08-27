<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $type = CW('post/type');
    $advs = $db->query('adv','',"position='{$type}'");
    $show = array();
    foreach ($advs as $adv){
        $click = $adv['click'];
        
        array_push($array_click,$click);
        if($click=='跳出APP到浏览器'){
            $action = $adv['content1'];
        }else if($click=='本APP内打开外链'){
            $action = $adv['content2'];
        }else if($click=='跳到APP内某个帖子'){
            $action = $adv['content3'];
        }else if($click=='跳到APP功能项'){
            $action = $adv['content4'];
        }else if($click=='跳到APP专题页'){
            $action = $adv['id'];
        }
        array_push($show,array(
            'id'=>$adv['id'],
            'src'=>$adv['cover'],
            'click'=>$click,
            'action'=>$action
        ));
    }
    echo json_encode(array(
        'adv'=>$show,
    )); 


        


?>