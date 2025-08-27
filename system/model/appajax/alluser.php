
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
  
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $more = get_data($db->query('users','',"tel!='{$tel}'",'id desc',"{$pagestart},".APPSIZE),$tel);
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
    
    function get_data($datas,$tel){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $follow = $db->query('follow','',"tel1='{$tel}' and tel2='{$data['tel']}'",'id desc',1);
          array_push($array,array(
                  'id'=>$data['id'],
                  'avatar'=>$data['avatar'],
                  'nickname'=>$data['nickname'],
                  'sex'=>$data['sex'],
                  'tel'=>$data['tel'],
                  'descs'=>$data['descs'],
                  'isfollow'=>$follow ? '取消关注' : '关注'
              ));
        }
        return $array;
    }
?>


