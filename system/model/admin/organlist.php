<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $topic_search = CW('get/topic')!=0 ? "topic like '%".CW('get/topic')."%' and " : '';
    $ishow = CW('get/ishow') ;
    if($ishow=='1'){
        $ishow = 'ishow=1 and ';
    }elseif ($ishow=='0') {
        $ishow = 'ishow=0 and ';
    }else{
        $ishow = '';
    }
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "title like '%$keyword%' and ";
    }
    $where = $topic_search.$ishow.$title." imglist != ''";
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
    	$url2 = INDEX.'/admin.php?mod=organ&id='.$article['id'];
    	
    	$title = functions::cutstr($article['title'],10);
    	
    	if($article['ishow']==1){
    	    $checked = "<p class='isall'>已审核</p>";
    	}else{
    	    $checked = "<input  rel='{$article['id']}' type='checkbox' />";
    	}
    	$data .= "<tr>
    	            <!--<td>{$checked}</td>-->
    	            <td>{$article['id']}</td>
                    <td>{$title}</td>
             
                    <td>{$article['hot']}</td>
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
    $tpl->compile('organlist','admin'); 
?>