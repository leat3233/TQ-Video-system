<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $vid = CW('gp/vid');
    $tel = CW('gp/tel');
    $tvid = CW('get/id',5);
    $isvideo = CW('gp/isvideo');
    $data = $db->query('post','',"id='{$vid}'",'',1);
    $tips = functions::gettips($data[0]['vipdiam'],$data[0]['diamond'],4);
    $topic = functions::gettopic(explode(',',$data[0]['topic']),5);
    $likes = functions::hot($data[0]['likes']);
    $time = date('Y-m-d',$data[0]['ftime']);
    $user = $db->query('users','',"tel='{$data[0]['userid']}'",'',1);
    $islike = $db->query('likes','',"tel='{$tel}' and postid='{$vid}'",'',1);
    $where = "ishow=1 and videocover!='' ";
    $data1 = get_data($db->query('post','',$where,'rand()',10),$isvideo);
    $follow = $db->query('follow','',"tel1='{$tel}' and tel2='{$data[0]['userid']}'");
    echo json_encode(array(
        'nickname'=>$user[0]['nickname'],
        'avatar'=>substr(str_replace('image','static',$user[0]['avatar']),3),
        'fs'=>$db->get_count('follow',"tel2='{$data[0]['userid']}'"),
        'num'=>$db->get_count('post',"userid='{$data[0]['userid']}'"),
        'title'=>$data[0]['title'],
        'like'=>$likes,
        'hot'=>functions::hot($data[0]['hot']),
        'diam'=>intval($data[0]['diamond'])>0 ? $data[0]['diamond'].'金币' : '免费',
        'ftime'=>$time,
        'id'=>$vid,
        'islike'=>$islike ? true : false,
        'user'=>$data[0]['userid'],
        'tags'=>explode(',',rtrim($data[0]['tags'],',')),
        'data'=>$data1,
        'follow'=>$follow ? '取消关注' : '关注',
        'pnum'=>functions::hot($data[0]['pnum']),
        'ptime'=>$data[0]['ptime'],
    ));
    function get_data($datas,$isvideo){
        $array = array();
        $db = functions::db();
        //$u = $isvideo=='is' ? 
        foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','',"tel='{$data['userid']}'",'',1);
          array_push($array,array(
                  'id'=>$data['id'],
                  'tit'=>$data['title'],
                  'src'=>$data['videocover'],
                  'tag'=>$tips,
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('../../static','/static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
              ));
        }
        return $array;
    }
?>