<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $keyword = CW('get/keyword');
    if($keyword){
        $tel = "tel like '%$keyword%' and ";
    }
    $where = $tel.' 1=1';
    $count = $db->get_count('withdrawals',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('withdrawals','',$where,'id desc',"{$page},".PAGESIZE);

    $data = '';
    foreach($articles as $article){
        
      
        
        
        if($article['state']==1){
            $state = "<p class='paystate'>已打款</p>";
            $btn = '';
        }else if($article['state']==2){
            $state = "<p class='paystate'>已拒绝</p>";
            $btn = '';
        }else{
            $state = "<p class='wpaystate'>待打款</p>";
            $btn = "<a class='btn btn1' href='javascript:;' rel='setpay' id='{$article['id']}' user='{$article['user']}' money='{$article['money']}'>设置已打款</a>";
            $btn2 = "<a style='margin-left:5px;background:#F4C414' class='btn btn1' href='javascript:;' rel='setrefpay' id='{$article['id']}' user='{$article['tel']}' money='{$article['money']}'>设置拒绝打款</a>";
        }
        
        
        
        
        
        
        
        
        
        
        
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	$data .= "<tr>
    	            <td>{$article['tel']}</td>
    				<td>{$article['money']}</td>
                    <td>{$article['paytype']}</td>
                    <td>{$article['cardmsg']}</td>
                    <td>{$time}</td>
                    <td>{$state}</td>
                    <td>
                        {$btn}{$btn2}
                        <a class='btn btn3 del' rel='withdrawals'  id='{$article['id']}' href='javascript:;' ><i class='fa fa-trash'></i>删除</a>
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
    $tpl->compile('withdrawals','admin'); 
?>