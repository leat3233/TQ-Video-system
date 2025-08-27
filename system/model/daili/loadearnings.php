<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $id = CW('get/id',3);
    $add = '';
    if($id){
        $add = "currtel='{$id}' and ";
    }
    $tel = functions::autocode(CW('cookie/daili__secret'),'-');
    $where = $add."parent='{$tel}'";
    $count = $db->get_count('earnings',$where,'id');
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    $earnings = $db->query('earnings','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($earnings as $earning){
        $time = date('Y-m-d h:i:s',$earning['ftime']);
          $tel  = substr($earning['currtel'],0,3).'******'.substr($earning['currtel'],-2);
        $a = "代理({$tel})充值{$earning['price']}元, 盈利{$earning['earnings']}元";
        $data .= "<tr><td>{$a}</td></tr>";
    }


    $allurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(stripos($allurl ,"&page=")){
    	$nallurl = substr($allurl,0,stripos($allurl ,"&page="));
    }else{
    	$nallurl = $allurl;
    }
    $pageurl = $nallurl.'&page=';
    $page = functions::page($count,$pagecount,$pageurl);

    $tpl =  new Society();
    $tpl->assign('data',$data);
    $tpl->assign('page',$page);
    $tpl->compile('loadearnings','user'); 
?>