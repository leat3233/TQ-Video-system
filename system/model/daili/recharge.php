<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $keyword = CW('get/keyword');
    if($keyword){
        $tel = "tel like '%$keyword%' and ";
    }
    $daili = functions::getdailiuser();
    $show = "tel in ({$daili}) and ";
    $where = $show.$tel.' 1=1';
    $count = $db->get_count('pays',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('pays','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	$state = $article['state'] ? "<p style='font-weight:bold;color:#78DDA5'>已支付</p>" : "<p style='font-weight:bold;color:red'>待支付</p>";
    	$paytype = $article['paytype'];
    	$type = substr($paytype,strripos($paytype,'-')+1);
        $id =substr($paytype,strrpos($paytype,'|')+1);
        $id =substr($id,0,strrpos($id,'-'));
        $money = '未知';
        if($type=='vip'){
            $money = $db->query('vipcard','',"id='{$id}'",'',1);$money = $money[0]['nowprice'];
        }else{
            $money = $db->query('diamcard','',"id='{$id}'",'',1);$money = $money[0]['price'];
        }
    
    	$data .= "<tr>
    	            <td>{$article['tel']}</td>
    				<td>{$article['pay']}</td>
    			
    				<td>{$article['payorder']}</td>
    				<td>{$article['mchorderno']}</td>
    				<td>{$time}</td>
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
    $tpl->assign('page',$page);
    $tpl->compile('recharge','daili'); 
?>
