<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $where = '1=1';
    $count = $db->get_count('selected',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('selected','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    	$data .= "<tr>
    	            <td>{$article['vid']}</td>
    				<td>{$article['star1']}星</td>
    				<td>{$article['star2']}星</td>
                    <td>
                        <a class='btn btn3 del' rel='selected'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('selectedlist','admin'); 
?>