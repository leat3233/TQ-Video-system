<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "tel like '%$keyword%' and ";
    }

    $where = $title." 1=1";
    $count = $db->get_count('sharelevel',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('sharelevel','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
        $ftime = date('Y-m-d H:i:s',$article['ftime']);
        $uu = $db->query('users','id',"tel='{$article['tel2']}'",'',1);
        $daili = INDEX."/uplivepopo.php?mod=index&auth=true&daili=".$article['tel'];
        $url = INDEX.'/admin.php?mod=user&id='.$uu[0]['id'];
    	$data .= "<tr>

    	            <td><a target='_blank' style='font-weight:bold;color:red' href='{$daili}'>{$article['tel']}</a></td>
                    <td><a target='_blank' style='font-weight:bold;color:red' href='{$url}'>{$article['tel2']}</a></td>
                  
                    <td>{$article['dev']}</td>
                
                    <td>{$ftime}</td>
                  
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
    $tpl->compile('dluser','admin'); 
?>