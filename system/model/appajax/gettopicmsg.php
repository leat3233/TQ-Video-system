<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $topic = CW('post/id');
    $data = $db->query('topic','',"id='{$topic}'",'',1);
     $num = $db->get_count('post',"instr(topic,'{$topic}')");
        echo json_encode(array(
            'cover'=>$data[0]['cover'],
            'desces'=>$data[0]['desces'],
            'num'=>$num,
            'state'=>1
        ));

?>