<?php 
    if(!defined('CW')){exit('Access Denied');}

    $db = functions::db();
    $where = '';

    $activity = $db->query('activity','','','id desc');
    $data = array();
    foreach($activity as $val){
      

      $time1 = date('Y-m-d',$val['time1']);  
      $time2 = date('Y-m-d',$val['time2']);  
      $ftime = date('Y-m-d',$val['ftime']);
      $state = 0;
      if($val['time1']>time()){
          $state = 2;
      }else if($val['time1']<time() && $val['time2']>time()){
          $state = 1;
      }else if($val['time2']<time()){
          $state = 3;
      }
      array_push($data,array(
          'cover'=>$val['cover'],
          'tit'=>$val['title'],
          'time'=>$time1.'至'.$time2,
          'state'=>$state,
          'action'=>$val['content1']
      ));
    }
    echo json_encode(array(
        'data'=>$data,
    ));
    
?>


