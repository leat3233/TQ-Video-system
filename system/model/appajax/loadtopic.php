<?php 
    if(!defined('CW')){exit('Access Denied');}
    $page = intval(abs(CW('get/page',1)));
    $db = functions::db();
    
    $articles = $db->query('topic','',$where,'id desc');
    $data = array();
    if(CW('post/append')=='append'){
        array_push($data,array(
            'name'=>"所有影片",
            'num'=>0,
            'desc'=>'',
            'id'=>0,
            'cover'=>$val['cover'],
            'index'=>0    
        ));
    }
    $index=0;
    foreach($articles as $val){
      $index++;
      $num = $db->get_count('post',"instr(topic,'{$val['id']}')");
        array_push($data,array(
            'name'=>$val['name'],
            'num'=>$num,
            'desc'=>$val['desces'],
            'id'=>$val['id'],
            'cover'=>$val['cover'],
            'index'=>$index
        ));
    }
    echo json_encode(array(
        'data'=>$data,
    ));
?>


