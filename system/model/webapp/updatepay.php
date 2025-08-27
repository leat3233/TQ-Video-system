<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    
    
    $res = $db->exec('pay','u',array(
        array(
            "pay1"=>CW('post/pay1'),
            "pay2"=>CW('post/pay2'),
            "pay3"=>CW('post/pay3'),
            "pay4"=>CW('post/pay4'),
            "pay5"=>CW('post/pay5'),
            "pay6"=>CW('post/pay6'),
            "pay7"=>CW('post/pay7'),
            "pay8"=>CW('post/pay8'),
            "pay9"=>CW('post/pay9'),
            "pay10"=>CW('post/pay10'),
            "pay11"=>CW('post/pay11'),
            "pay12"=>CW('post/pay12'),
            "pay13"=>CW('post/pay13'),
            "pay14"=>CW('post/pay14'),
            "pay15"=>CW('post/pay15'),
        ),array(
            "id"=>1
        )));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>