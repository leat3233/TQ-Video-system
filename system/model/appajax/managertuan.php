
<?php 
    header('Content-Type: application/json');
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $type = CW('gp/type');
    $tel = CW('gp/tel');

    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $where = "tel='{$tel}'";
    

    $more = array();
    $datas = $db->query('tuan','',$where,'id desc',"{$pagestart},".APPSIZE);
    foreach($datas as $data){
           
      $desc = $db->query("select descs from users where tel='{$data['tel']}' limit 1");
      array_push($more,array(
        'id'=>$data['id'],
        'tel'=>$data['tel'],
        'nickname'=>$data['nickname'],
        'shengao'=>$data['shengao'],
        'zhiye'=>$data['zhiye'],
        'tizhong'=>$data['tizhong'],
        'city'=>$data['city'],
        'nianling'=>$data['nianling'],
        'xingbie'=>$data['xingbie'],
        'wx'=>$data['wx'],
        'desc'=>$desc[0]['descs'],
        'show'=>true,
        'cover'=>explode('|',$data['imglist'])[0],
      ));
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
    

?>


