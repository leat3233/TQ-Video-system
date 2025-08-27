<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $mod = 'fromcommentslist';
    $idlist = CW('post/idlist');
  
    $db = functions::db();
    
    $idlist = explode(',',$idlist);
    foreach ($idlist as $id){
        $topiclist = $db->query('post','topic',"id='{$id}'",'',1);
        $array = explode(',',$topiclist[0]['topic']);
        foreach ($array as $val){
            $num = $db->query('topic','num',"id='{$val}'",'',1);
            $num = intval($num[0]['num'])+1;
            $db->exec('topic','u',"num='{$num}',id='{$val}'");
        }
        $res = $db->exec('comments','u',array(array(
            'ishow'=>'1',
           
            'ftime'=>time()
        ),array(
            'id'=>$id
        )));
    }
    if($res){
        
        msg('操作成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','error',true);
    }
   
    
?>