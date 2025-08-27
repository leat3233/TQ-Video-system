<?php

    $db = functions::db();
    //$json = file_get_contents("php://input");
    //$data = json_decode($json);
    //file::debug(json_encode($_REQUEST));
    //file::debug($_REQUEST['title']);
    $topics = $db->query("SELECT id FROM topic order by rand() limit 2");
    $ttt = '';
    foreach ($topics as $topic){
        $ttt .= $topic['id'].',';
    }
    $ttt = rtrim($ttt,',');

    $sets = $db->query('sets','g2,g3,g4','id=1','',1);
    $tmplname = $sets[0]['g2'];
    $usertype = $sets[0]['g3'];//单用户
    $g4 = $sets[0]['g4'];


    $title = $_REQUEST['title'];
    
    $exist = $db->query('post','',"title='{$title}'",'',1);
    if($exist){
        return;
    }
    if($usertype=='单用户'){
         $tel = $g4;
    }else{
        $tel = $db->query("SELECT tel FROM users where xn=1 order by rand() limit 1");$tel = $tel[0]['tel'];
    }

   
    $cover = $_REQUEST['pic'];
    $url = $_REQUEST['url'];
    
    $ptime = $_REQUEST['duration'];
    // $topic = $data->category;
    // $topic = $db->query('topic','id',"name='{$topic}'",'',1);
    // $topic = $topic[0]['id'];
    $price = mt_rand(5,20);
    $price2 = $price-3;
    
    $rand = mt_rand(1,10);
    if($rand<3){
        $price = $price2 = 0;
    }
    
    
    
    
    $topic = 0;
    if($tmplname=='短视频'){
        $res = $db->exec('post','i',array(
            'title'=>$title,
            'userid'=>$tel,
            'shortvidcover'=>$cover,
            'shortvidurl'=>$url,
            'topic'=>$ttt,
            'ptime'=>$ptime,
            'ftime'=>time(),
            'ishow'=>1,
            'diamond'=>$price,
            'vipdiam'=>$price2,
            'likes'=>mt_rand(100,2000),
            'pnum'=>mt_rand(100,2000),
            'hot'=>mt_rand(100,2000)
            // 'biaoqian'=>$arrtostr2,
            // 'ts'=>$ts
        ));
    }else{
        $res = $db->exec('post','i',array(
            'title'=>$title,
            'userid'=>$tel,
            'videocover'=>$cover,
            'videourl'=>$url,
            'topic'=>$ttt,
            'ptime'=>$ptime,
            'ftime'=>time(),
            'ishow'=>1,
            'diamond'=>$price,
            'vipdiam'=>$price2,
            'likes'=>mt_rand(100,2000),
            'pnum'=>mt_rand(100,2000),
            'hot'=>mt_rand(100,2000)
            // 'biaoqian'=>$arrtostr2,
            // 'ts'=>$ts
        ));
    }
?>