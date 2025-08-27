<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

//$_user = functions::getuser();
    $daili = functions::getdailiuser();
    $show = "tel in ({$daili}) and ";
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "tel like '%$keyword%' and ";
    }
    $where = $show.$title." 1=1";
    $count = $db->get_count('users',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('users','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
        $url2 = INDEX.'/admin.php?mod=user&id='.$article['id'];
        if($article['systemtype']){
            $phonetype = $article['systemtype'].'('.$article['systemversion'].')';
        }else{
            $phonetype = '';
        }
    	$time = date('H:i:s',$article['logintime']);
    	$lnum = $article['lnum'];
    	$isvip = $article['viptime']>time() ? 'VIP' : '否';
    	$data .= "<tr>

    	            <td>{$article['nickname']}</td>
                    <td>{$isvip}</td>
                  
                    <td>{$article['card']}</td>
                    <td>{$article['diam']}</td>
                    <td>{$article['money']}</td>
                  
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
    $tpl->compile('userlist','daili'); 
?>