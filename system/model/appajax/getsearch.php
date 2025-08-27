<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $val = CW('post/val');
    $where = "title like '%{$val}%'";
  
    $data = get_data($db->query('post','',"ishow=1 and videocover!='' and {$where}",'id desc',100));
    
    echo json_encode(array(
        'data'=>$data
    ));
    
    
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          array_push($array,array(
                  'id'=>$data['id'],
                  'tit'=>$data['title'],
                  'src'=>$data['videocover'],
                  'tag'=>$tips,
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
              ));
        }
        return $array;
    }
?>