<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
     $id = CW('post/id');
    if(!$id){
    	msg('ID错误,请重新登录','确定','javascript:location.reload()','error');
    }
    $db = functions::db();
    $position = CW('post/position');
    if($position=='APP视频播放页'){
        $postid = CW('post/postid');
        if(!$postid){
            msg('视频帖子ID还未设置','刷新','','',true);
        }
    }elseif ($position=='APP应用中心') {
        
    }else{
        //msg('请重新选择广告位置!','刷新','','',true);
    }
    $tel = CW('post/tel');//视频帖子ID
    $postid = CW('post/postid');//视频帖子ID
    $remarks = CW('post/remarks');
    if($remarks){
        if(strlen($remarks)>255){
            msg('广告备注最多255个字符','刷新','','',true);
        }
    }
    $imgcover = CW('post/imgcover');
    if(!$imgcover){
        msg('广告封面还没上传','刷新','','',true);
    }
    $endtime = strtotime(CW('post/endtime'));
    if($endtime){
        if($endtime<time()){
            msg('广告时间设置错误','刷新','','',true);
        }
    }else{
        $endtime = 0;
    }
    $select = CW('post/select');
   
    if($select=='跳出APP到浏览器'){
        $content1 = CW('post/content1');
        if(!$content1){
            msg('请设置外链','刷新','','',true);
        }
    }elseif($select=='本APP内打开外链'){
        $content2 = CW('post/content2');
        if(!$content2){
            msg('请设置外链','刷新','','',true);
        }
    }elseif($select=='跳到APP内某个帖子'){
        $content3 = CW('post/content3');
        if(!$content3){
            msg('请输入帖子ID','刷新','','',true);
        }
    }elseif($select=='跳到APP功能项'){
        $content4 = CW('post/content4');
        if(!$content4){
            msg('请选择功能项','刷新','','',true);
        }
    }elseif($select=='跳到APP专题页'){
        $content5 = CW('post/content5',5);
        if(!$content5){
            msg('请设置专题页内容, 支持图片等. 请注意排版','刷新','','',true);
        }
        $content5 = str_replace("\"","'",$content5);
    }else{
        msg('请重新选择广告点击效果!','刷新','','',true);
    }
    $res = $db->exec('adv','u',array(array(
            'tel'=>$tel,
            'position'=>$position,
            'postid'=>$postid,
            'cover'=>$imgcover,
            'remarks'=>$remarks,
            'endtime'=>$endtime,
            'click'=>$select,
            'content1'=>$content1,
            'content2'=>$content2,
            'content3'=>$content3,
            'content4'=>$content4,
            'content5'=>$content5
        ),array(
            'id'=>$id    
        )));
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>