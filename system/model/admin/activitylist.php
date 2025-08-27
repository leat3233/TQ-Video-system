<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
   
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "title like '%$keyword%' and ";
    }

    $where = $title." 1=1";
    $count = $db->get_count('activity',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('activity','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	$url2 = INDEX.'/admin.php?mod=activity&id='.$article['id'];
    	$time1 = date('Y-m-d H:i:s',$article['time1']);
    	$time2 = date('Y-m-d H:i:s',$article['time2']);
    	if(!$time2){
    	    $time2 = '永久';
    	}
    	$activitytime = $time1.' 至 '.$time2;
    	$data .= "<tr>
    	            <td>{$article['title']}</td>
                    <td><img class='activitycover' src='{$article['cover']}' /></td>
                    <td>{$activitytime}</td>
                    <td>{$time}</td>
                    <td>
                        <a class='btn btn2' href='{$url2}'><i class='fa fa-edit'></i>编辑</a>
                        <a class='btn btn3 del' rel='activity'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
                    </td>
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
    $tpl->compile('activitylist','admin'); 
?>