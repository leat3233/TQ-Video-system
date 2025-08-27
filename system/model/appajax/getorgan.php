
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $id = CW('post/id');
    $tel = CW('post/tel');
    $where = "imglist!='' and ishow=1 and id='{$id}'";
    $data = get_data($db->query('post','',$where,'id desc',1));
    $islike = $db->query('likes','',"tel='{$tel}' and postid='{$id}'",'',1);
    //输出
    echo json_encode(array(
        'data'=>$data,
        'islike'=>$islike ? true : false,
    ));
    
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $time = date('m-d H:i',$data['ftime']);
          $user = $db->query('users','',"tel='{$data['userid']}'",'',1);
          $imglist =explode('|',$data['imglist']);
          $num = count($imglist);
          $likes = functions::hot($data['likes']);
          $comments = $db->get_count('comments','postid='.$data['id'].' and ishow=1');
          $comments = $comments ? $comments : 0;
          $topic_array = array();
          foreach ($data['topic'] as $v){
              $topicname = functions::getfield('topic','name',"id='{$v}'");
              array_push($topic_array,array(
                'id'=>$v,
                'name'=>$topicname
              ));
          }
          $islike = $db->query('likes','',"tel='{$tel}' and postid='{$id}'",'',1);
          array_push($array,array(
            'id'=>$data['id'],
            'user'=>$user,
            'user_avatar'=>str_replace('image','static',$user[0]['avatar']),
            'time'=>date('Y-m-d',$user[0]['ftime']),
            'title'=>$data['title'],
            'imgnum'=>$num,
            'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
            'imglist'=>$imglist,
            'topic'=>$topic_array,
            'like'=>$likes,
            'plnum'=>$comments,
            'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman',
            'islike'=>$islike ? true : false,
            'u'=>$user[0]['tel']
          ));
        }
        return $array;
    }
?>


