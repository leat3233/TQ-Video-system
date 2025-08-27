<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

    $tel = CW('post/tel');
    
    $fabutime = $db->query('users','fabutime',"tel='{$tel}'",'',1);
    $fabutime = $fabutime[0]['fabutime'];

    if(($fabutime+600)>time()){
        echo json_encode(array(
            'err'=>'两次发布时间过短'
        ));return;
    }
    $ntime = time();
    $db->exec('users','u',"fabutime='{$ntime}',tel='{$tel}'");
    
    $client = CW('post/client');
    $user = $db->query('users','id,freeze',"tel='{$tel}'",'',1);
    if(!$user[0]['id']){
        echo json_encode(array(
            'err'=>'当前用户异常, 不允许上传'
        ));return;
    }
    if($user[0]['freeze']){
        echo json_encode(array(
            'err'=>'账号已被冻结, 不允许上传'
        ));return;
    }
    $textarea = CW('post/title');
    if(strlen($textarea)>255){
        echo json_encode(array(
            'err'=>'标题字数超过限制, 请重新填写'
        ));return;
    }
    $topiclist = CW('post/topic_id');
    $img0 = CW('file/img0');
    $img1 = CW('file/img1');
    $img2 = CW('file/img2');
    $img3 = CW('file/img3');
    $img4 = CW('file/img4');
    $img5 = CW('file/img5');
    $img6 = CW('file/img6');
    $img7 = CW('file/img7');
    $img8 = CW('file/img8');
    $tempcover = $tempurl = '';
    if(!file_exists(IMGS)){
        file::mk_dir(IMGS);
    }
    $img_list  = '';
    if($img0){
        if($res0 = uploadimg($img0)){
            $tempurl = $client=='app' ? $res0 : '';
            $img_list .= $res0.'|';
        }
    }
    if($img1){
        if($res1 = uploadimg($img1)){
            $tempcover = $client=='app' ? $res1 : '';
            $img_list .= $res1.'|';
        }
    }
    if($img2){
        if($res2 = uploadimg($img2)){
            $img_list .= $res2.'|';
        }
    }
    if($img3){
        if($res3 = uploadimg($img3)){
            $img_list .= $res3.'|';
        }
    }
    if($img4){
        if($res4 = uploadimg($img4)){
            $img_list .= $res4.'|';
        }
    }
    if($img5){
        if($res5 = uploadimg($img5)){
            $img_list .= $res5.'|';
        }
    }
    if($img6){
        if($res6 = uploadimg($img6)){
            $img_list .= $res6.'|';
        }
    }
    if($img7){
        if($res7 = uploadimg($img7)){
            $img_list .= $res7.'|';
        }
    }
    if($img8){
        if($res8 = uploadimg($img8)){
            $img_list .= $res8.'|';
        }
    }
    $img_list = substr($img_list,0,-1);
    $typeobj = CW('post/type');
    $res = '';
   
    if($typeobj=='长视频'){
        $res = $db->exec('post','i',array(
            'title'=>$textarea,
            'userid'=>$tel,
            'videocover'=>$tempcover,
            'videourl'=>$tempurl,
            'topic'=>$topiclist,
            'ptime'=>'',
            'ftime'=>time(),
            'ishow'=>1
        ));
    }else if($typeobj=='短视频'){
        $res = $db->exec('post','i',array(
            'title'=>$textarea,
            'userid'=>$tel,
            'ptime'=>'',
            'shortvidcover'=>$tempcover,
            'shortvidurl'=>$tempurl,
            'topic'=>$topiclist,
            'ftime'=>time(),
            'ishow'=>1
        ));
    }else{
        $res = $db->exec('post','i',array(
            'title'=>$textarea,
            'userid'=>$tel,
            'imglist'=>$img_list,
            'topic'=>$topiclist,
            'ftime'=>time(),
            'ishow'=>1
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
    function uploadimg($img){
        $imgs_error = $img['error'];
        if ($imgs_error > 0){
            if($imgs_error==1){
                $err = '上传的文件超过了服务器限制的最高值';
            }elseif ($imgs_error==2) {
                $err = '上传文件的大小超过了前端指定的最高值';
            }elseif ($imgs_error==3) {
                $err = '文件上传不完整';
            }elseif ($imgs_error==4) {
                $err = '没有文件被上传';
            }elseif ($imgs_error==6) {
                $err = '找不到临时文件夹';
            }elseif ($imgs_error==7) {
                $err = '文件写入失败';
            }
            echo json_encode(array(
                  'err'=>'视频文件上传失败!'
            ));return;
        }
       
        $name = $img['name'];
        $type = $img['type'];
        $size = $img['size'];
        $tempname = $img['tmp_name'];
        
        if($size>0){
        // if(($type=='video/mp4' || $type=='video/mov' || $type=='image/jpeg' || $type=='image/jpg' || $type=='image/gif' || $type=='image/png' || $type==='image/pjpeg') && $size>0){
            $filename = md5(uniqid()).strstr($name,'.');
            $url = IMGS.$filename;
            if(move_uploaded_file($tempname, $url)) {
        		return IMGSURL.$filename;
            }else{
                return '';
            }
            
        }
    }
?>


