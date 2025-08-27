<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $diamcardid = CW('post/diamcardid');
    if(!$diamcardid){
    	msg('ID错误,请重新登录','确定','javascript:location.reload()','error');
    }

    $diamnum = CW('post/diamnum');
    $give = CW('post/give');
    $descs = CW('post/descs');
    $price = CW('post/price');
    $tag = $_POST['tag'];
    $db = functions::db();

    if(strlen($descs)>16 || strlen($descs)<3){
    	msg('描述字符要求为3-16个字符,最多16个字符','刷新','javascript:location.reload()','',true);
    }
    if($tag){
        if(strlen($tag)>15 || strlen($tag)<3){
        	msg('小标签字符要求为3-15个字符,最多5个汉字','刷新','javascript:location.reload()','',true);
        }
    }
    
    
    $res = $db->exec('diamcard','u',array(
        array(
            "diamnum"=>intval($diamnum),
            "give"=>intval($give),
            "descs"=>$descs,
            "price"=>intval($price),
            "tag"=>$tag,
        ),array(
            "id"=>$diamcardid
        )));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>