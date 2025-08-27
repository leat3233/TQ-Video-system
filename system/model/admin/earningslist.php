<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    
    $keyword = CW('get/keyword');
    if($keyword){
        $tel = "payuser like '%$keyword%' and ";
    }
    $t = functions::getuser();
    // $lv = $db->query('share','lv',"son='{$t}'");
    // $daili = functions::getdailiuser();
    // $show = "tel in ({$daili}) and ";
    // $where = $show.$tel.' 1=1';
  
    $count = $db->get_count('sharerecord',$tel."father='{$t}'",'id');
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    $articles = $db->query('sharerecord','',$tel."father='{$t}'",'id desc',"{$page},".PAGESIZE);
    
    $data = '';
    foreach($articles as $article){
        
        $time = date('Y-m-d H:i:s',$article['ftime']);
        $l = $article['lv']/100*$article['price'];
    	$data .= "<tr>
    	           <td>{$article['payuser']}</td>
    	           <td>{$article['price']}</td>
    				<td>{$l}</td>
    				
    				
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
    $tpl->compile('earningslist','admin'); 
?>