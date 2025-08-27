<?php 
    if(!defined('CW')){exit('Access Denied');}
    $page = intval(abs(CW('get/page',1)));
    $db = functions::db();
    $mtype = CW('post/mtype');
    $tel = CW('post/tel');
    $sysmessage = '';
  
    $data = array();
    if($mtype=='我的消息'){
        $avatar = $db->query('users','avatar',"tel='{$tel}'",'',1);
        $avatar = $avatar[0]['avatar'];
        $sysmessage = $db->query('message','',"tel='{$tel}'",'id desc');
        foreach($sysmessage as $article){
          $time = date('Y-m-d H:i:s',$article['ftime']);  
            array_push($data,array(
                'time'=>$time,
                'avatar'=>str_replace('image','static',$avatar),
                'content'=>$article['desces']
            ));
        }
    }else{
        $sysmessage = $db->query('sysmessage','',"mtype='{$mtype}'",'id desc');
        foreach($sysmessage as $article){
          $time = date('Y-m-d H:i:s',$article['ftime']);  
            array_push($data,array(
                'time'=>$time,
                'avatar'=>'../../static/avatar/admin.webp',
                'content'=>$article['content']
            ));
        }
    }
    
    
    
    echo json_encode(array(
        'data'=>$data
    ));
?>


