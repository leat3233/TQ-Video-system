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
    	$daili = $article['tel'];
    	$all_click = $db->get_count('click',"dailiuser='{$daili}'");
    
    	$tuijian  = explode('-',getData('首页-推荐',$daili,$all_click));
    	$huati  = explode('-',getData('首页-话题',$daili,$all_click));
        $huiyuan  = explode('-',getData('会员-会员',$daili,$all_click));
        $jinbi  = explode('-',getData('会员-金币',$daili,$all_click));
        $pianku  = explode('-',getData('会员-片库',$daili,$all_click));
        $yingyong  = explode('-',getData('应用中心',$daili,$all_click));
        $bofang  = explode('-',getData('播放页',$daili,$all_click));
        $tangquan  = explode('-',getData('糖圈-推荐',$daili,$all_click));
    	
    	
    	$url_tuijian = INDEX."/admin.php?mod=click&daili=".$daili.'&type=首页-推荐';
    	$url_huati = INDEX."/admin.php?mod=click&daili=".$daili.'&type=首页-话题';
    	$url_huiyuan = INDEX."/admin.php?mod=click&daili=".$daili.'&type=会员-会员';
    	$url_jinbi = INDEX."/admin.php?mod=click&daili=".$daili.'&type=会员-金币';
    	$url_pianku = INDEX."/admin.php?mod=click&daili=".$daili.'&type=会员-片库';
    	$url_yingyong = INDEX."/admin.php?mod=click&daili=".$daili.'&type=应用中心';
    	$url_bofang = INDEX."/admin.php?mod=click&daili=".$daili.'&type=播放页';
    	$url_tangquan = INDEX."/admin.php?mod=click&daili=".$daili.'&type=糖圈-推荐';
    
    	
    	$data .= "<tr>
    	            <td>{$daili}</td>
    	            <td><a href='{$url_tuijian}' target='_blank' class='c'>{$tuijian[0]}/{$tuijian[1]}%</a></td>
    	            <td><a href='{$url_huati}' target='_blank' class='c'>{$huati[0]}/{$huati[1]}%</a></td>
    	            <td><a href='{$url_huiyuan}' target='_blank' class='c'>{$huiyuan[0]}/{$huiyuan[1]}%</a></td>
    	            <td><a href='{$url_jinbi}' target='_blank' class='c'>{$jinbi[0]}/{$jinbi[1]}%</a></td>
    	            <td><a href='{$url_pianku}' target='_blank' class='c'>{$pianku[0]}/{$pianku[1]}%</a></td>
    	            <td><a href='{$url_tangquan}' target='_blank' class='c'>{$tangquan[0]}/{$tangquan[1]}%</a></td>
    	            <td><a href='{$url_yingyong}' target='_blank' class='c'>{$yingyong[0]}/{$yingyong[1]}%</a></td>
    	            <td><a href='{$url_bofang}' target='_blank' class='c'>{$bofang[0]}/{$bofang[1]}%</a></td>
    	            
    	            <td class='b'>{$all_click}/100%</td>
                    <!--<td>
                        <a class='btn btn3 del' rel='dluser'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
                    </td>-->
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
    $tpl->compile('clicklist','admin'); 
    
    function getData($position,$daili,$all_click){
        $db = functions::db();
        $a = $db->get_count('click',"position='{$position}' and dailiuser='{$daili}'");
    	$b = round($a/$all_click,2)*100;
    	$b = $b>0 ? $b : 0;
    	return $a.'-'.$b;
    }
?>
