<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $rewardtype = CW('post/rewardtype');
    $reward = CW('post/reward');
    $id = CW('post/id',1);

   
    $res = $db->exec('signinset','u',array(
        array(
        'rewardtype'=>$rewardtype,
    	'reward'=>$reward
        ),array(
            "id"=>$id
        )));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>