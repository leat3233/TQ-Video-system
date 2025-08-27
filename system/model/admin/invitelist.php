<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $keyword = CW('get/keyword');
    if($keyword){
        $tel = "tel like '%$keyword%' and ";
    }
    $where = $tel.' 1=1';
    $count = $db->get_count('level',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;

    $articles = $db->query('level','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
        $time = date('Y-m-d H:i:s',$article['ftime']);
    	$data .= "<tr>
    	            <td>{$article['tel']}</td>
    				<td>{$article['tel2']}</td>
    				<td>{$article['level']}</td>
    				<td>{$time}</td>
                </tr>";
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
    $tpl->compile('invitelist','admin'); 
?>