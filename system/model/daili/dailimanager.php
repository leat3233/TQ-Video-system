<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
   
    $keyword = CW('get/keyword');
    if($keyword){
        $title = "son like '%$keyword%' and ";
    }
    $daili = functions::getuser();
    $show = "father='{$daili}' and ";
    $where = $show.$title." 1=1";
    $count = $db->get_count('share',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('share','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
      
    	$time = date('Y-m-d H:i:s',$article['ftime']);
        $url2 = INDEX.'/user.php?mod=open&id='.$article['id'];
        $url = INDEX.'/share.php?card='.functions::autocode('v'.$article['son']);
    	$data .= "<tr>

                    <td>{$article['son']}</td>
                  
                    <td>{$article['lv']}%</td>
                    <td>{$url}</td>
                    <td>{$time}</td>
                   <td><a class='btn btn2' href='{$url2}'><i class='fa fa-edit'></i>编辑</a>
                        <a class='btn btn3 del' rel='share'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a></td>
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
    $tpl->compile('dailimanager','daili'); 
?>