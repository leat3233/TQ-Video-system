
<?php 
    header('Content-Type: application/json');
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $type = CW('gp/type');
    global $tel;
    $tel = CW('gp/tel');
    $tel1 = CW('gp/tel');
    $where = "imglist!='' and ishow=1";

    $page = CW('gp/page') ? CW('gp/page') : 0;

    
    $pagestart = $page*APPSIZE;
    $more = '';

    if($type=='tj'){
        $organcommentsuser = $db->query('organcommentsuser','organcommentsuser','','id asc',1);
        $organcommentsuser = $organcommentsuser[0]['organcommentsuser'];
        $where = "imglist!='' and ishow=1 and userid in($organcommentsuser)";
        $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
    }else if($type=='new'){
        $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
    }else if($type=='gz'){
       
       $followlists = $db->query('follow','tel2',"tel1='{$tel1}'");
      
       $yui = '';
       foreach ($followlists as $followlist){
           $yui .= $followlist['tel2'].',';
           
       }
       $yui= rtrim($yui,',');
        $where = "imglist!='' and ishow=1 and userid in($yui)";
        $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
       
       
    }else if($type=='tuan'){
        $where = "imglist!='' and ishow=1 and userid='{$tel}'";
        $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
    }
    
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
 
          $islike = $db->query('likes','',"tel='{$GLOBALS['tel']}' and postid='{$data['id']}'",'',1);
          array_push($array,array(
            'id'=>$data['id'],
            'user'=>$user,
            'user_avatar'=>$user[0]['avatar'],
            'u'=>$user[0]['tel'],
            'time'=>date('Y-m-d',$user[0]['ftime']),
            'title'=>$data['title'],
            'imgnum'=>$num,
            'imglist'=>$imglist,
            'topic'=>$topic_array,
            'like'=>$likes,
            'plnum'=>$comments,
            'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman',
            'islike'=>$islike ? true : false
          ));
        }
        return $array;
    }
?>


