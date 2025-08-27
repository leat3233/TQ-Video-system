<?php 
    if(!defined('CW')){exit('Access Denied');}
    $page = intval(abs(CW('gp/page',1)));
    $db = functions::db();
    $selecttime = CW('gp/selecttime');
    if($selecttime){
        $where = 'selecttime='.$selecttime.' and num>0';
    }
    $day0 =  strtotime(date('Y-m-d',time()))+intval($selecttime)*60*60;
   
    $hour = date('G',time());
    if(time()>$day0 && time()<($day0+600)){
        $button = '购买';
    }else if(time()>($day0+601)){
        $button = '已结束';
    }else{
        $button = '未开始';
    }

    $articles = $db->query('seckill','',$where,'id desc');
    $data = array();
    foreach($articles as $article){
        $post = $db->query('post','id,videocover,diamond,title,videourl',"id='{$article['vid']}'",'',1);
        if(time()>$day0 && time()<($day0+600)){
            $id = $article['id'];
        }else{
            $id = '';
        }
        //$id = $article['id'];
        array_push($data,array(
           'title'=> $post[0]['title'],
           'src'=>$post[0]['videocover'],
           'price'=>$article['pricediamond'],
           'num'=>$article['num'],
           'state'=>$button,
           'id'=>$id
        ));
    }
    echo json_encode(array(
        'data'=>$data,
    ));
?>