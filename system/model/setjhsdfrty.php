<?php 
    if(!defined('CW')){exit('Access Denied');}
     $isphone = functions::is_mobile();
    if(!$isphone){
        //exit("请在手机端打开");
    }
    $tpl =  new Society();
    $db = functions::db();
    
    $tel = CW('get/tel');
    $fabutime = $db->query('users','fabutime',"tel='{$tel}'",'',1);
    $fabutime = $fabutime[0]['fabutime'];
    if(($fabutime+H*60*60)>time()){
        $tpl->compile('a','');return;
    }
    
    
    
    
    
    
    
    $category = '';
    $topices = $db->query('topic','id,name','');
    foreach ($topices as $topic){
        $category .= "<div class='row topic height-center'><input name='check_box' rel='{$topic['id']}' type='checkbox'>{$topic['name']}</div>";
    }
    $tpl->assign('category',$category);
    $tpl->assign('tel',$tel);
    $biaoqians = $db->query('biaoqian','name','');
    $data = '';
    foreach ($topices as $biaoqian){
        $data .= "<p>{$biaoqian['name']}</p>";
    }
    $tpl->assign('data',$data);
    
    $tpl->assign('jinbi',$db->query('sets','jinbi','id=1','',1)[0]['jinbi']);
    $tpl->compile('upload',''); 
?>