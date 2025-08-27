<?php 
    if(!defined('CW')){exit('Access Denied');}
    $page = intval(abs(CW('get/page',1)));
    $db = functions::db();
   
    $apps = $db->query('app','','','id desc');
    $data = array();
    foreach($apps as $app){
        array_push($data,array(
            'src'=>$app['cover'],
            'tit'=>$app['name'],
            'num'=>$app['num'],
            'desc'=>$app['desces'],
            'url'=>$app['downloadurl']
        ));
      
    }
     echo json_encode(array(
            'data'=>$data
        ));
?>


