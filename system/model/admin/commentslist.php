<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $ishow = CW('get/ishow');
    if($ishow=='1'){
        $ishow = 'ishow=1 and ';
    }elseif ($ishow=='0') {
        $ishow = 'ishow=0 and ';
    }else{
        $ishow = '';
    }
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "comments like '%$keyword%' and ";
    }
    $where = $ishow.$title." 1=1";
    $count = $db->get_count('comments',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;

    $articles = $db->query('comments','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	if($article['ishow']){
    	    $checked = "<p class='isall'>已审核</p>";
    	}else{
    	    $checked = "<input  rel='{$article['id']}' type='checkbox' />";
    	}
    	$data .= "<tr>
    	            <td>{$checked}</td>
    	            <td>{$article['tel']}</td>
                    <td>{$article['comments']}</td>
                    <td>{$article['postid']}</td>
                    <td>{$time}</td>
                    <td>
                        <a class='btn btn3 del' rel='comments'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('commentslist','admin'); 
?>