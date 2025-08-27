<?php 
    header('content-type:text/html;charset=utf-8');
   
    
   
   
   
    $db = functions::db();
    $img0 = CW('file/img0');
    $tempcover = $tempurl = '';
    if(!file_exists(IMGS)){
        file::mk_dir(IMGS);
    }

    if($img0){
        if($res0 = uploadimg($img0)){
            
            $data = functions::get_contents("https://api.uomg.com/api/qr.encode?url={$res0}");
            $data = json_decode($data)->qrurl;
          
            $ttel = $data;
           
            //$db = functions::db();
            //$lgtime = $db->query('users','logintime',"tel='{$ttel}'",'',1);
            //file::debug($lgtime[0]['logintime']);
            // if($lgtime[0]['logintime'] && ($lgtime[0]['logintime']+600)>time()){
            //     $data = 'in';
            // }
            //file::debug($data);
            echo json_encode(array(
                's'=>$ttel
            ));
        }
    }
  
    function request_post($url = '', $param = ''){
    if (empty($url) || empty($param)) {
        return false;
    }

    $postUrl = $url;
    $curlPost = $param;
    // 初始化curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $postUrl);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    // 要求结果为字符串且输出到屏幕上
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // post提交方式
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    // 运行curl
    $data = curl_exec($curl);
    curl_close($curl);

    return $data;
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


