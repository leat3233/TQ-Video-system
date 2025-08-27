
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $where = "ishow=1 and videocover!='' ";
   
   
    $data = get_data($db->query('post','',$where,'rand()',10));
    
    //热词
    $hotsearchs = $db->query('sets','hotsearch','id=1','',1);
    $hotsearch_array = explode(',',$hotsearchs[0]['hotsearch']);
    $keyword = array();
    $num = 0;
    if($hotsearchs[0]['hotsearch']){
        foreach ($hotsearch_array as $hot){
            $num++;
            array_push($keyword,array(
                'num'=>$num,
                'keyword'=>$hot
            ));
        }
    }
    
    //输出
    echo json_encode(array(
        'data'=>$data,
        'keyword'=>$keyword
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
              ));
        }
        return $array;
    }
?>


