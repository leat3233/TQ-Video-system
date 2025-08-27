    <?php 
    global $tel;
    $tel = CW('post/tel');
    $type = intval(CW('post/type'));
    $db = functions::db();
    $where = "ishow=1 and shortvidurl!=''";
    $t = CW('post/tel');
    $set = $db->query('sets','set1,set2','id=1','',1);
    if($type==1){
        $postidlists = $db->query('follow','tel2',"tel1='{$t}'");
        foreach($postidlists as $postidlist){
            $postid_list .= $postidlist['tel2'].',';
        }
        $postid_list = rtrim($postid_list,',');
        $where .= " and userid in('$postid_list')";
    }else if($type==100){
        $vid = CW('post/vid');
        $where .= " and id in($vid)";
    }
    
    file::debug($where);
    $db->exec(CW('get/data',5));
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
    echo json_encode(array(
        'more'=>$more,
        'page'=>intval($page)+1
    ));
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','',"tel='{$data['userid']}'",'',1);
          $islike = $db->query('likes','',"tel='{$GLOBALS['tel']}' and postid='{$data['id']}'",'',1);
          $num = $db->get_count('comments',"postid='{$data['id']}' and ishow=1");
          $isfollow =$db->query('follow','',"tel1='{$GLOBALS['tel']}' and tel2='{$data['userid']}'");
          $tips = $tips2 = functions::gettips($data['vipdiam'],$data['diamond']);
          $me = $db->query('users','viptime',"tel='{$GLOBALS['tel']}'",'',1);
          $isvip = $db->query('users','viptime,usertel',"tel='{$GLOBALS['tel']}'",'',1);
          if($tips=='vip'){
              
              if($isvip[0]['viptime']>time()){
                  $tips = '';
              }
          }
          $isbind = $isvip[0]['usertel'] ? true : false;
          
          $exist = $db->query('buyrecord','',"tel='{$GLOBALS['tel']}' and paytype='buyvid' and payid='{$data['id']}'");
          if($exist){
              $tips = '';
          }
          array_push($array,array(
                  'id'=>$data['id'],
                  'userid'=>$user[0]['tel'],
                  'mylevel'=>$user[0]['mylevel'],
                  'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman',
                  'username'=>$user[0]['nickname'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'cover'=>$data['shortvidcover'],
                  'src'=>$data['shortvidurl'],
                  'title'=>$data['title'],
                  'content'=>$data['title'],
                  'tag'=>$tips,
                  'tag2'=>$tips2,
                  'diam'=>$me[0]['viptime']>time() ? $data['vipdiam'] : $data['diamond'],
                  'u'=>$user[0]['tel'],
                  'isPlaying'=>false,
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'showCover'=>false,
                  'likes'=>functions::hot($data['likes']),
                  'islike'=>$islike ? true : false,
                  'pinglunnum'=> $num==0 ? '首评' : functions::hot($num),
                  'isfollow'=>$isfollow ? true : false,
                  'mfisover'=>false,
                  'diamisover'=>false,
                  'vipisover'=>false,
                  'isbind'=>$isbind,
                  'spingling'=>false,
                  'vidurl'=>INDEX.'/index.php?mod=shortvideo&shortvidcover='.$data['shortvidcover'].'&shortvidurl='.$data['shortvidurl']
              ));
        }
        return $array;
    }
?>