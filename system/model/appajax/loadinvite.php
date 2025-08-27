<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('gp/tel');
    $where = "tel='{$tel}'";
    $count = $db->get_count('level',$where,'id');
    $levels = $db->query('level','',$where,'id desc');
    $data = array();
    foreach($levels as $level){
        
        $time = date('Y-m-d h:i:s',$level['ftime']);
        //$tel  = substr($level['tel2'],0,3).'******'.substr($level['tel2'],-2);
        $tel = $level['tel2'];
        array_push($data,array(
            'tel'=>$tel,
            'time'=>$time
        ));
    }
    
    echo json_encode(array(
        'data'=>$data,
        'count'=>$count
    ));
?>


