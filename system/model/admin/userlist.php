<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $ishow = CW('get/ishow') ;
    if($ishow=='1'){
        $ishow = 'freeze=1 and ';
    }elseif ($ishow=='0') {
        $ishow = 'freeze=0 and ';
    }else{
        $ishow = '';
    }
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "tel like '%$keyword%' and ";
    }
    $where = $ishow.$title." 1=1";
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
    	$tm = date('Y-m-d H:i:s',$article['ftime']);
    	$xn = $article['xn'] ? "<span style='color:red;font-weight:bold'> [虚拟用户]</span>" : '';
    	$data .= "<tr>

    	            <td>{$article['nickname']}{$xn}</td>
    	            <td>{$tm}</td>
                   
                    <td>{$article['card']}</td>
                    <td>{$article['diam']}</td>
                    <td>{$article['money']}</td>
                    <td>{$article['sex']}</td>
                    <td>
                        <a class='btn btn2' href='{$url2}'><i class='fa fa-edit'></i>编辑</a>
                        <a class='btn btn3 del' rel='users'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('userlist','admin'); 
?>