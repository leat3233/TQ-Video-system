<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();

    $res = $db->exec('sets','u',array(
        array(
           
            'set1'=>CW('post/set1'),
            'set2'=>CW('post/set2')
        ),array(
            "id"=>1
        )));
   
    //if($res){
    	msg('设置成功!','确定','','success');
    //}else{
    //    msg('数据无变动!','重填','javascript:location.reload()','',true);
    //}
?>