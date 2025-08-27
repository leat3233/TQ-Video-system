    <?php 
    if(!defined('CW')){exit('Access Denied');}
    $id = intval(CW('post/id'));
    $tel = CW('post/tel');
    $db = functions::db();
    $where = "ishow=1 and shortvidurl!=''";
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $more = get_data($db->query('post','',$where,'id desc',"{$pagestart},".APPSIZE));
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
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'userid'=>$user[0]['tel'],
                  'username'=>$user[0]['nickname'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'cover'=>$data['shortvidcover'],
                  'src'=>$data['shortvidurl'],
                  'content'=>$data['title'],
                  'isPlaying'=>false,
                  'showCover'=>false,
                  'tag'=>$tips,
                  'diam'=>$data['diamond']
              ));
        }
        return $array;
    }
?>