
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $where = "ishow=1 and videocover!='' and vipdiam>0 ";
   
   
    $data_1 = get_data($db->query('post','',$where,'rand()',6));
    $data_2 = get_data($db->query('post','',$where."and  instr(flag,'钻石精选')",'id desc',6));
    $data_3 = get_data($db->query('post','',$where."and  instr(flag,'钻石地表最强推荐')",'rand()',6));
    $data_4 = get_data($db->query('post','',$where,'likes desc',9));
    $data_5 = get_data($db->query('post','',$where,'hot desc',6));
    
    $data_6 = get_data($db->query('post','',$where."and  instr(flag,'钻石福利')",'id desc',5));
    // $datas = get_data($db->query('post','',$where."and  instr(flag,'钻石福利')",'id desc',5));
    // $num = 0;
    // foreach($datas as $data){
    //       $tips = functions::gettips($data['vipdiam'],$data['diamond']);
    //       $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
    //       $state = !$num ? true : false;$num++;
    //       array_push($data_6,array(
    //           'isBig'=>$state,
    //           'id'=>$data['id'],
    //           'tit'=>$data['title'],
    //           'src'=>$data['videocover'],
    //           'tag'=>$tips,
    //           'diam'=>$data['diamond'],
    //           'avatar'=>str_replace('image','static',$user[0]['avatar']),
    //           'nickname'=>$user[0]['nickname'],
    //           'uid'=>$user[0]['tel'],
    //       ));
    // }
    $data_7 = get_data($db->query('post','',$where,'rand()',20));
    //输出
    echo json_encode(array(
        'data_1'=>$data_1,
        'data_2'=>$data_2,
        'data_3'=>$data_3,
        'data_4'=>$data_4,
        'data_5'=>array(
            'data'=>$data_5    
        ),
        'data_7'=>$data_7,
        'data_6'=>$data_6
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


