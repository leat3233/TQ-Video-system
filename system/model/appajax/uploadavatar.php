<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    
    $img = CW('file/file');
    
    if(!file_exists(IMGS)){
        file::mk_dir(IMGS);
    }
    $avatar = uploadimg($img);
    $res = $db->exec("update users set avatar='{$avatar}' where tel='{$tel}'");
    
    
    if($res){
        $user = $db->query('users','avatar',"tel='{$tel}'",'',1);
        echo json_encode(array(
           'data'=>'上传成功' ,
           'avatar'=>$avatar
        ));
    }else{
        echo json_encode(array(
           'err'=>'上传失败' 
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
                  'err'=>$err
            ));return;
        }
       
        $name = $img['name'];
        $type = $img['type'];
        $size = $img['size'];
        $tempname = $img['tmp_name'];
        
        if(($type=='image/jpeg' || $type=='image/jpg' || $type=='image/gif' || $type=='image/png' || $type==='image/pjpeg') && ($size < 30*1024*1024) && $size>0){
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


