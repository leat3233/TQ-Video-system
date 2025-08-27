<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
   
    $where = "tel='{$tel}'";
    $ids ='';
    $sellvideos = $db->query('buyrecord','payid',$where,'id desc');
    foreach ($sellvideos as $sellvideo){
        $ids .= $sellvideo['payid'].',';
    }
    $ids = rtrim($ids,',');
    $where2 = "id in  ($ids)";
    $data = get_data($db->query('post','',$where2));
    //输出
    echo json_encode(array(
        'data'=>$data
    ));
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);

          $cover = $data['videocover'] ? $data['videocover'] : $data['shortvidcover'];
          $type = $data['videocover'] ? "长视频" : "短视频";
          array_push($array,array(
                  'id'=>$data['id'],
                  'tit'=>$data['title'],
                  'src'=>$cover,
                  'tag'=>$tips,
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
                  'u'=>$user[0]['tel'],
                  'type'=>$type
              ));
        }
        return $array;
    }
    
?>


