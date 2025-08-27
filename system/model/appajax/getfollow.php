<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel1 = CW('post/tel1');
    $tel2 = CW('post/tel2');
    $db = functions::db();
    if($tel1==$tel2){
        echo json_encode(array(
            'err'=>'您不能关注自己',
        ));return;
    }
    $where = "tel1='{$tel1}' and tel2='{$tel2}'";
    $exist = $db->query('follow','',$where,'',1);
    //file::debug(json_encode($exist));return;
    if($exist){
        $res = $db->exec('follow','d',$where);
        if($res){
            $userfans = $db->get_count('follow',"tel2='{$tel2}'");
            echo json_encode(array(
                'follow'=>"关注",
                'fs'=>functions::hot($userfans)
            ));
        }
        
    }else{
        $res = $db->exec('follow','i',array(
            'tel1'=>$tel1,
            'tel2'=>$tel2,
            'ftime'=>time()
        ));
        if($res){
            $userfans = $db->get_count('follow',"tel2='{$tel2}'");
            echo json_encode(array(
                'follow'=>"取消关注",
                'fs'=>functions::hot($userfans)
            ));
        }
    }

    
?>


