    <?php 
    if(!defined('CW')){exit('Access Denied');}
    $id = CW('gp/id');
    $tel = CW('gp/tel');
    $orderby = 'id desc';
    $db = functions::db();
    $where = "ishow=1 and videocover!='' ";
    if($id=='随机'){
        $orderby = "rand()";
    }else if($id=='置顶' || $id=='大V推荐' || $id=='精品优选' || $id=='推荐' || $id=='VIP热播'){
        $where =  $where." and  instr(flag,'{$id}')";
        $orderby = 'updatetime desc';
    }else if($id=='大家都在看'){
        $orderby = 'hot desc';
    }else{
        $where =  $where."and  instr(topic,'{$id}')";
    }
    
    //file::debug(json_encode($_POST));
    
    
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $more = get_data($db->query('post','',$where,$orderby,"{$pagestart},".APPSIZE));
 
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
                  'avatar'=>substr(str_replace('image','static',$user[0]['avatar']),3),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
              ));
        }
        return $array;
    }
?>