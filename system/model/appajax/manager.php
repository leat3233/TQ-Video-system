<?php 
    if(!defined('CW')){exit('Access Denied');}
    $type = intval(CW('post/type',1));
    $tel = CW('post/tel');
    $db = functions::db();
    if($type==1){
        $where = 'ishow=1';
    }elseif ($type==2) {
        $where = 'ishow=2';
    }elseif ($type==3) {
        $where = 'ishow=3';
    }else{
        $where = '';
    }
    $where = $where ? $where." and userid='{$tel}' and imglist=''" : "userid='{$tel}' and imglist=''";
    $posts = $db->query('post','',$where,'id desc');
    $data = array();
    foreach($posts as $post){
      $cover = $post['videocover'] ? $post['videocover'] : $post['shortvidcover'];
      $time = date('m-d H:i',$post['ftime']);
      if($post['ishow']=='1'){
          $state = '审核成功';
      }else if($post['ishow']=='2'){
          $state = '审核中';
      }else if($post['ishow']=='3'){
          $state = '视频不符合要求';
      }
      array_push($data,array(
          'cover'=>$cover,
          'title'=>$post['title'],
          'time'=>$time,
          'id'=>$post['id'],
          'state'=>$state,
          'type'=>$post['videocover'] ? 'longvideo' : 'shortvideo'
      ));
      
      
    }
    echo json_encode(array(
        'data'=>$data,
    ));
    
?>


