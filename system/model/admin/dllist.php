<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $keyword = CW('get/keyword');
    if($keyword){
        $tel = "tel like '%$keyword%' and ";
    }
    $where = $tel.' 1=1';
    $count = $db->get_count('dluser',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('dluser','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
        $daili = INDEX."/uplivepopo.php?mod=index&auth=true&daili=".$article['tel'];
        $url2 = INDEX.'/admin.php?mod=dlopen&id='.$article['id'];
    	$data .= "<tr>
    	            <td><a target='_blank' style='font-weight:bold;color:red' href='{$daili}'>{$article['tel']}</a></td>
    				<td>{$article['dailipass']}</td>
    				<td>{$article['bili']}%</td>
    				<!--<td>{$article['state']}</td>-->
    			
                    <td>
                        <a class='btn btn2' href='{$url2}'><i class='fa fa-edit'></i>编辑</a>
                        <a class='btn btn3 del' rel='dluser'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('dllist','admin'); 
?>
