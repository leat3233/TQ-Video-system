<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel = CW('gp/tel');
    $db = functions::db();
    $where = "tel1='{$tel}'";
    $follows = $db->query('follow','',$where,'id desc');
    $users = array();
    $listsers = $db->query('users','','','rand()',4);
        $text=2;
        foreach($listsers as $listser){
          
          array_push($users,array(
              'avatar'=>str_replace('image','static',$listser['avatar']),
              'sex'=>$listser['sex']=='男' ?  'man' : 'woman',
              'nickname'=>$listser['nickname'],
              'descs'=>$listser['descs'],
              'tel'=>$listser['tel'],
              'u'=>$listser['tel']
          ));

    }
    $where = "ishow=1 and videocover!='' ";
    $data_1 = get_data($db->query('post','',$where,'rand()',20));
    echo json_encode(array(
        'users'=>$users,
        'data'=>$data_1
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
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
                  'u'=>$user[0]['tel']
              ));
        }
        return $array;
    }
?>


