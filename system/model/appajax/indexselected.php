
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $selecteds = $db->query('selected','','','id desc');
    $array = array();
    foreach ($selecteds as $val){
        $post = $db->query('post','',"id='{$val['vid']}'",'',1);
        $user =  $db->query('users','nickname,avatar,tel',"tel='{$post[0]['userid']}'",'',1);
        $tips = functions::gettips($post[0]['vipdiam'],$post[0]['diamond']);
        array_push($array,array(
            'id'=>$val['vid'],
            'cover'=>$post[0]['videocover'],
            'tag'=>$tips,
            'ptime'=>$data['ptime'],
          'hot'=>functions::hot($data['hot']),
          'pnum'=>functions::hot($data['pnum']),
            'diam'=>$post[0]['diamond'],
            'hot'=>functions::hot($post[0]['hot']),
            'like'=>functions::hot($post[0]['likes']),
            'x1'=>floor($val['star1']),
            'x2'=>floor($val['star2']),
            'title'=>$post[0]['title'],
            'avatar'=>str_replace('image','static',$user[0]['avatar']),
            'nickname'=>$user[0]['nickname'],
            'u'=>$user[0]['tel'],
            'categorys'=>array(
                'id'=>8,
                'name'=>"测试标题"
            )
        ));
    }
    //输出
    echo json_encode(array(
        'data'=>$array
    ));
    
?>


