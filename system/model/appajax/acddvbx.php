<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
   
    $tel = CW('post/tel');
    $user = $db->query('users','',"tel='{$tel}'",'',1);
    if(!$user[0]['id']){
        echo json_encode(array(
            'err'=>'当前用户异常, 不允许上传'
        ));return;
    }
    $fabutime = $db->query('users','fabutime',"tel='{$tel}'",'',1);
    $fabutime = $fabutime[0]['fabutime'];
    if(($fabutime+1)>time()){
        echo json_encode(array(
            'err'=>'两次发布时间过短'
        ));return;
    }
    
   
    
    $title = CW('post/title');
    if(strlen($title)<9 || strlen($title)>45){
        echo json_encode(array(
            'err'=>'标题要求9-45个字符或3-15个汉字'
        ));return;
    }
    
    $coverurl = CW('post/titlepic');//视频封面
    $odownpath1 = CW('post/odownpath1');//视频链接
    
    
    if (strpos($odownpath1, 'm3u8') !== false) {
        
    } else {
        echo json_encode(array(
            'err'=>'请勿篡改数据!'
        ));return;
    }
    
    
    
    
    
    
    
    if(!$coverurl){
        echo json_encode(array(
            'err'=>'视频封面未正确上传'
        ));return;
    }
    if(!$odownpath1){
        echo json_encode(array(
            'err'=>'视频未正确上传'
        ));return;
    }
   
    $topic = '';
    $arrtostr = $arrtostr2 = CW('post/arrtostr');//标签
    $arrtostr = explode(',',$arrtostr);
    foreach ($arrtostr as $tostr){
        $id = $db->query('topic','id',"name='{$tostr}'");
        $topic .= $id[0]['id'].',';
    }
    $topic = rtrim($topic,',');
 

    $ntime = time();
    $db->exec('users','u',"fabutime='{$ntime}',tel='{$tel}'");
    $res = false;
    if(CW('post/ts')=='短视频'){
        $res = $db->exec('post','i',array(
            'title'=>$title,
            'userid'=>$tel,
            'shortvidcover'=>$coverurl,
            'shortvidurl'=>$odownpath1,
            'topic'=>$topic,
            'ptime'=>CW('post/playtime'),
            'ftime'=>time(),
            'ishow'=>1,
            'diamond'=>0,
            'vipdiam'=>0,
            'likes'=>mt_rand(100,2000),
            'pnum'=>mt_rand(100,2000)
            // 'biaoqian'=>$arrtostr2,
            // 'ts'=>$ts
        ));
    }else{
        $res = $db->exec('post','i',array(
            'title'=>$title,
            'userid'=>$tel,
            'videocover'=>$coverurl,
            'videourl'=>$odownpath1,
            'topic'=>$topic,
            'ptime'=>CW('post/playtime'),
            'ftime'=>time(),
            'ishow'=>1,
            'diamond'=>$price,
            'vipdiam'=>$price2,
            'likes'=>mt_rand(100,2000),
            'pnum'=>mt_rand(100,2000)
            // 'biaoqian'=>$arrtostr2,
            // 'ts'=>$ts
        ));
    }
    

    
    
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'数据库异常,上传失败!!'
        ));
    }

?>


