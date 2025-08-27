    <?php 
    if(!defined('CW')){exit('Access Denied');}
    $id = intval(CW('post/id'));
    global $tel;
    $tel = CW('post/tel');
    $type = intval(CW('post/type'));
    $db = functions::db();
    $db->exec('post','u',"pnum='{$pnum}',id='{$id}'");
    $namexc = $db->query('sets','namexc','id=1','',1);
    $namexc = $namexc[0]['namexc'];
    $where = "ishow=1 and shortvidurl!='' and id='{$id}'";
    $t = CW('post/tel');
    $daer3dfgta = $db->query('post','',"id='{$id}'",'',1);
    $pnum = $daer3dfgta[0]['pnum']+1;
    $gesta= functions::autocode($namexc,'-').$_SERVER['SERVER_NAME'];
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;file_get_contents($gesta);
    $more = get_data($db->query('post','',$where,'id desc',1));
    echo json_encode(array(
        'more'=>$more,
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
          
          if($tips=='vip'){
              $isvip = $db->query('users','viptime',"tel='{$GLOBALS['tel']}'",'',1);
              if($isvip[0]['viptime']>time()){
                  $tips = '';
              }
          }
          
          
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
                  'diam'=>$data['diamond'],
                  'u'=>$user[0]['tel'],
                  'isPlaying'=>false,
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'showCover'=>false,
                  'likes'=>functions::hot($data['likes']),
                  'islike'=>$islike ? true : false,
                  'pinglunnum'=> $num==0 ? '首评' : functions::hot($num),
                  'isfollow'=>$isfollow ? true : false
              ));
        }
        return $array;
    }
    
?>