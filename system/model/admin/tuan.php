<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
   
    $keyword = CW('get/keyword');$city = CW('get/city');
    if($keyword){
        $title = "tel like '%$keyword%' and ";
    }
    if($city){
        $title = $title. "city like '%$city%' and ";
    }
    $where = $title." 1=1";
    $count = $db->get_count('tuan',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('tuan','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
        $url2 = INDEX.'/admin.php?mod=t&id='.$article['id'];

    	$data .= "<tr>
 <td>{$article['tel']}</td>
    	            <td>{$article['nickname']}</td>
    	            <td>{$article['shengao']}</td>
                   
                    <td>{$article['zhiye']}</td>
                    <td>{$article['tizhong']}</td>
                    <td>{$article['city']}</td>
                    <td>{$article['nianling']}</td>
                    <td>{$article['xingbie']}</td>
                    <td>{$article['wx']}</td>
                    <td>
                        <a class='btn btn2' href='{$url2}'><i class='fa fa-edit'></i>编辑/查看</a>
                        <a class='btn btn3 del' rel='tuan'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('tuan','admin'); 
?>


