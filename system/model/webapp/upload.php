<?php
	if(!defined('CW')){exit('Access Denied');}logincheck();
    $size = SIZE;
    $file = CW("file/file");

    if($file['error']==1){
    	echo '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
    	return;
    }elseif ($file['error']==2) {
    	echo '上传文件大小不符合规定值';
    	return;
    }elseif ($file['error']==3) {
    	echo '文件上传不完整';
    	return;
    }elseif ($file['error']==4) {
    	echo '请先选择文件';
    	return;
    }
    
    if(!file_exists(VIDEO)){
        file::mk_dir(VIDEO);
    }

    if(($file['type']=='image/jpeg' || $file['type']=='image/png'  || $file['type']=='image/pjpeg' || $file['type']=='video/mp4') && ($file["size"] < SIZE*1024*1024) && $file["size"]>0){
        $filename = md5(uniqid()).strstr($file['name'],'.');
  
        if(move_uploaded_file($file['tmp_name'], VIDEO.$filename)) {   
            echo VIDEOURL.$filename;
        } else {
            echo '上传失败!';
        }
    }else{
        echo '文件格式错误或者文件大小不符合要求';
    }
?>
