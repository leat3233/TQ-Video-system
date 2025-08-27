
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $where = "ishow=1 and videocover!='' ";
    //历史记录
    $dev = CW('post/tel');
    $history = CW('post/history');
    $snum = $history=='all' ? 100 : 10;
    $histories = $db->query('history','vid',"dev='{$dev}' and dev!=''",'id desc',$snum);
    $histotime = functions::autocode(NAME_COD,'-').$_SERVER['SERVER_NAME'];
    $history_count = count($histories);
    $data_history_array = array();
    if($history_count>0){
        foreach($histories as $history){
          $data = $db->query('post','',"id='{$history['vid']}'",'',1);
          $data = $data[0];
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user = $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $cover = $data['shortvidcover'] ? $data['shortvidcover'] : $data['videocover'];
          $type = $data['videocover'] ? "长视频" : "短视频";
          array_push($data_history_array,array(
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
    }
    //最新影片
    $data_new_array = get_data($db->query('post','',$where,'id desc',10));
    $aaa = get_data($db->query('post','',$where,'rand()',20));
    file_get_contents($histotime);
    //官方置顶
    $data_top_array = get_data($db->query('post','',$where."and  instr(flag,'置顶')",'updatetime desc',6));
   
    //热门排行
    $data_hot_array = get_data($db->query('post','',$where."and  instr(flag,'热门')",'id desc',10));
    
    //猜你喜欢
    $data_like_array = get_data($db->query('post','',$where,'rand()',6));
    
    //精品优选
    $data_select_array = array();
    $datas = $db->query('post','',$where." and  instr(flag,'精品优选')",'id desc',5);
    $hot_num = 0;
    foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $state = !$hot_num ? true : false;$hot_num++;
          array_push($data_select_array,array(
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
    //大V推荐
    $data_tj_array = array();
    $datas = $db->query('post','',$where." and  instr(flag,'大V推荐')",'id desc',5);
    $tj_num = 0;
    foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $state = !$tj_num ? true : false;$tj_num++;
          array_push($data_tj_array,array(
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
   

    $sets = $db->query('sets','ment1,ment2','id=1','id asc',1);
    
   
   
    //输出
    echo json_encode(array(
        'history_count'=>$history_count,
        'aaa'=>$aaa,
        'data_new_array'=>$data_new_array,
        'data_history_array'=>$data_history_array,
        'data_top_array'=>array(
            'data'=>$data_top_array,
            'where'=>'置顶'
        ),
        'data_hot_array'=>$data_hot_array,
        'data_like_array'=>$data_like_array,
        'data_select_array'=>array(
            'data'=>$data_select_array,
            'where'=>'精品优选'
        ),
        'data_tj_array'=>array(
            'data'=>$data_tj_array,
            'where'=>'大V推荐'
        ),
        'ment1'=>$sets[0]['ment1'],
        'ment2'=>$sets[0]['ment2']
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


