<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

    $tel = CW('post/tel');
    
    $input1 = CW('post/input1');
    $input2 = CW('post/input2');
    $input3 = CW('post/input3');
    $input4 = CW('post/input4');
    $input5 = CW('post/input5');
    $input6 = CW('post/input6');
    $input7 = CW('post/input7');
    $input8 = CW('post/input8');
  

    $client = 'app';
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

    $res = '';
   
    $res = $db->exec('tuan','i',array(
        'tel'=>$tel,
        'nickname'=>$input1,
        'imglist'=>$img_list,
        'shengao'=>$input2,
        'zhiye'=>$input3,
        'tizhong'=>$input4,
        'city'=>$input5,
        'nianling'=>$input6,
        'xingbie'=>$input7,
        'wx'=>$input8,
        'ftime'=>time()
    ));
    
    
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'服务器繁忙, 请稍后再试!'
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


