<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel = CW('post/tel');
    $type = intval(CW('post/type',1));
    $posttype = CW('post/posttype');
    $postid = CW('post/postid',1);
    if(!$postid){
        echo json_encode(array(
            'err'=>'ID异常, 操作失败'
        ));return;
    }
    $db = functions::db();
    $exist = $db->query('users','',"tel='{$tel}'",'',1);
    if(!$exist){
        echo json_encode(array(
            'state'=>1,
            'err'=>'当前用户异常, 操作失败'
        ));return;
    }
    $islike = $db->query('likes','',"tel='{$tel}' and postid='{$postid}'",'',1);
    if($islike){
        $res = $db->exec('likes','d',"tel='{$tel}' and postid='{$postid}'");
        if($res){
            $return_like = getlike($db,$postid)-1;
            $db->exec('post','u',"likes='{$return_like}',id='{$postid}'");
            // echo json_encode(array(
            //     'success'=>1    
            // ));
        }
        // else{
        //     echo json_encode(array(
        //         'err'=>"操作失败"    
        //     ));
        // }
        echo json_encode(array(
            'res'=>functions::hot(getlike($db,$postid)),
            'islike'=>false
        ));
    }else{
        $res = $db->exec('likes','i',array(
            'tel'=>$tel,
            'postid'=>$postid,
            'posttype'=>$posttype,
            'ftime'=>time()
        ));
        if($res){
            $return_like = getlike($db,$postid)+1;
            $db->exec('post','u',"likes='{$return_like}',id='{$postid}'");
        }
        echo json_encode(array(
            'res'=>functions::hot(getlike($db,$postid)),
            'islike'=>true
        ));
    }
    

    function getlike($db,$postid){
        $likes = $db->query('post','likes',"id='{$postid}'",'',1);
        $return_like = intval($likes[0]['likes']);
        return intval($return_like);
    }
    

?>