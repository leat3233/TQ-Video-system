
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $topicid = CW('gp/topicid');
    $where = "ishow=1 and videocover!='' and instr(topic,'{$topicid}')";
  
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
    //输出
    if(!$more){
        echo json_encode(array(
            'more'=>'over',
        ));return;
    }
    echo json_encode(array(
        'more'=>$more,
        'page'=>intval($page)+1
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


