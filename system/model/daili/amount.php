<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    
   
    $t = functions::getuser();
    // $lv = $db->query('share','lv',"son='{$t}'");
    // $daili = functions::getdailiuser();
    // $show = "tel in ({$daili}) and ";
    // $where = $show.$tel.' 1=1';
    $where = "tel='{$t}'";
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
            $state = "<p  style='color:#3FCF7F;font-weight:bold'>已打款</p>";
        }else if($article['state']==2){
            $state = "<p style='color:red;font-weight:bold'>拒绝打款</p>";
        }else{
            $state = "<p style='color:#aaa;font-weight:bold'>审核并打款中</p>";
        }
        
        $time = date('Y-m-d H:i:s',$article['ftime']);
        $data .= "<tr>
    	           <td>{$article['money']}</td>
    	           <td>{$time}</td>
    			   <td>{$article['cardmsg']}</td>
    			    <td>{$state}</td>
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
    $tpl->assign('user',$t);
    $tpl->assign('page',$page);
    $money = $db->query('users','money',"tel='{$t}'",'',1);
    $money = $money[0]['money'];
    $tpl->assign('money',$money);
    $tpl->compile('amount','daili'); 
?>