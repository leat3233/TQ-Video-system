<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $ishow = CW('get/ishow') ;
    if($ishow=='公开'){
        $ishow = "ishow=1 and ";
    }elseif ($ishow=='屏蔽') {
        $ishow = "ishow=0 and ";
    }else{
        $ishow = '1=1 and ';
    }
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "title like '%$keyword%' and ";
    }
    $where = "shortvidurl!='' and ".$ishow.$title.' 1=1';
    $count = $db->get_count('post',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('post','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	$url2 = INDEX.'/admin.php?mod=shortvideo&id='.$article['id'];
    	$cover = $article['shortvidcover'];
    	$type = $article['diamond']>0 ? 'VIP' : '免费';
    	if($article['vipdiam']>0){
    	 $type =    $article['vipdiam'];
    	}elseif($article['diamond']>0){
    	    $type = "会员";
    	}else{
    	    $type = "免费";
    	}
    	$data .= "<tr>
    	            <td>{$article['id']}</td>
    	            <td>{$type}</td>
    				<td><img class='cover' src='{$cover}' /></td>
                    <td>{$article['title']}</td>
             
                    <td>{$article['likes']}</td>
                    <td>{$time}</td>
                    <td>
                        <a class='btn btn2' href='{$url2}'><i class='fa fa-edit'></i>编辑</a>
                        <a class='btn btn3 del' rel='post'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    
    $topics = $db->query('topic','id,name');
    $c = '';
    foreach ($topics as $topic){
    	$c .="<option value='{$topic['id']}'>{$topic['name']}</option>";
    }
    $tpl->assign('topic',$c);
    $tpl->compile('shortvideomanager','admin'); 
?>