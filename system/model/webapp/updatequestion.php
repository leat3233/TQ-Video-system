<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $q = CW('post/q');
    $a = CW('post/a');
    $qaid = CW('post/qaid',1);

   
    $res = $db->exec('question','u',array(
        array(
        'question'=>$q,
    	'answer'=>$a
        ),array(
            "id"=>$qaid
        )));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>