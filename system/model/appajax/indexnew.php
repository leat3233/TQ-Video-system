
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $where = "ishow=1 and videocover!='' ";
   
    //推荐
    $data_1 = array();
    $datas = $db->query('post','',$where." and  instr(flag,'推荐')",'id desc',5);
    $num = 0;
    foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $state = !$num ? true : false;$num++;
          array_push($data_1,array(
              'isBig'=>$state,
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
    //大家都在看
    $data_2 = array();
    
    $datas = $db->query('post','',$where,'hot desc',5);
    $num = 0;
    foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $state = !$num ? true : false;$num++;
          array_push($data_2,array(
              'isBig'=>$state,
              'id'=>$data['id'],
              'tit'=>$data['title'],
              'src'=>$data['videocover'],
              'tag'=>$tips,
              'ptime'=>$data['ptime'],
              'hot'=>$data['hot'],
              'pnum'=>$data['pnum'],
              'diam'=>$data['diamond'],
              'avatar'=>str_replace('image','static',$user[0]['avatar']),
              'nickname'=>$user[0]['nickname'],
              'uid'=>$user[0]['tel'],
              'u'=>$user[0]['tel']
          ));
    }
    //今日热搜
    $data_3 = get_data($db->query('post','',$where."and  instr(flag,'热搜')",'id desc',6));
    
    //最新话题
    $topicid = $db->query('topic','id','','id desc',1);
    $data_4 = get_data($db->query('post','',$where." and instr(topic,'{$topicid[0]['id']}')",'id desc',6));
    //今日热搜
    $data_5 = get_data($db->query('post','',$where,'rand()',20));
    //今日热搜
    //$rand = get_data($db->query('post','',$where,'rand()',5));
    $data_0 = array();
    $datas = $db->query('post','',$where,'rand()',5);
    $num = 0;
    foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $state = !$num ? true : false;$num++;
          array_push($data_0,array(
              'isBig'=>$state,
              'id'=>$data['id'],
              'tit'=>$data['title'],
              'src'=>$data['videocover'],
              'tag'=>$tips,
              'ptime'=>$data['ptime'],
              'hot'=>$data['hot'],
              'pnum'=>$data['pnum'],
              'diam'=>$data['diamond'],
              'avatar'=>str_replace('image','static',$user[0]['avatar']),
              'nickname'=>$user[0]['nickname'],
              'uid'=>$user[0]['tel'],
              'u'=>$user[0]['tel']
          ));
    }
    //输出
    echo json_encode(array(
        'data_1'=>array(
            'data'=>$data_1,
            'where'=>'推荐'
        ),
        'data_2'=>array(
            'data'=>$data_2,
            'where'=>'大家都在看'
        ),
        'data_3'=>$data_3,
        'data_4'=>array(
            'data'=>$data_4,
            'where'=>$topicid[0]['id']
        ),
        'data_5'=>$data_5,
        'data_0'=>array(
            'data'=>$data_0,
            'where'=>'随机'
        ),
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
                  'u'=>$user[0]['tel']
              ));
        }
        return $array;
    }
?>


