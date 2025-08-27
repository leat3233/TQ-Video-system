<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "tel like '%$keyword%' and ";
    }
    $where = $title.' 1=1';
    $count = $db->get_count('message',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    $articles = $db->query('message','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);

    	$data .= "<tr>
    	            <td>{$article['tel']}</td>
    				<td>{$article['mtype']}</td>
                    <td>{$article['desces']}</td>
                    <td>{$time}</td>
                    <td>
                        <a class='btn btn3 del' rel='message'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('messagelist','admin'); 
?>