<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $daili = CW('get/daili');
    $type = CW('get/type');
    $keyword = CW('post/keyword');
    $keyword = $keyword ? "tel like '%{$keyword}%' and " : '';
    
    $where = $keyword."dailiuser='{$daili}' and position='{$type}'";
    $count = $db->get_count('click',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
 
    $articles = $db->query('click','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach($articles as $article){
    
    	
    	$ftime = date('Y-m-d H:i:s',$article['ftime']);
    	$data .= "<tr>
    	           <td>{$article['position']}</td>
    	           <td>{$article['tel']}</td>
    	           <td>{$article['advid']}</td>
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
    
    $where = "dailiuser='{$daili}' and position='{$type}'";
    
    
    $midnight = strtotime("today midnight");
    $endOfDay = strtotime("tomorrow midnight") - 1;
    $ytime1 = strtotime(date("Y-m-d",strtotime("-1 day")));
    $yetime1 = $ytime1+24 * 60 * 60-1;
    $ytime2 = strtotime(date("Y-m-d",strtotime("-2 day")));
    $yetime2 = $ytime2+24 * 60 * 60-1;
    $ytime3 = strtotime(date("Y-m-d",strtotime("-3 day")));
    $yetime3 = $ytime2+24 * 60 * 60-1;
    $ytime4 = strtotime(date("Y-m-d",strtotime("-4 day")));
    $yetime4 = $ytime2+24 * 60 * 60-1;
    $ytime5 = strtotime(date("Y-m-d",strtotime("-5 day")));
    $yetime5 = $ytime2+24 * 60 * 60-1;
    $ytime6 = strtotime(date("Y-m-d",strtotime("-6 day")));
    $yetime6 = $ytime2+24 * 60 * 60-1;
    $all = $db->get_count('click',$where);
    $num0 = $db->get_count('click',$where."and ftime between $midnight and $endOfDay");$_num0 = round($num0/$all,2)*100;
    $_num0 = $_num0>0 ? $_num0 : 0;
    $num1 = $db->get_count('click',$where."and ftime between $ytime1 and $yetime1");$_num1 = round($num1/$all,2)*100;$_num1 = $_num1>0 ? $_num1 : 0;
    $num2 = $db->get_count('click',$where."and ftime between $ytime2 and $yetime2");$_num2 = round($num2/$all,2)*100;$_num2 = $_num2>0 ? $_num2 : 0;
    $num3 = $db->get_count('click',$where."and ftime between $ytime3 and $yetime3");$_num3 = round($num3/$all,2)*100;$_num3 = $_num3>0 ? $_num3 : 0;
    $num4 = $db->get_count('click',$where."and ftime between $ytime4 and $yetime4");$_num4 = round($num4/$all,2)*100;$_num4 = $_num4>0 ? $_num4 : 0;
    $num5 = $db->get_count('click',$where."and ftime between $ytime5 and $yetime5");$_num5 = round($num5/$all,2)*100;$_num5 = $_num5>0 ? $_num5 : 0;
    $num6 = $db->get_count('click',$where."and ftime between $ytime6 and $yetime6");$_num6 = round($num6/$all,2)*100;$_num6 = $_num6>0 ? $_num6 : 0;
    
    $tpl->assign('num0',$num0."--->{$_num0}%");
    $tpl->assign('num1',$num1."--->{$_num1}%");
    $tpl->assign('num2',$num2."--->{$_num2}%");
    $tpl->assign('num3',$num3."--->{$_num3}%");
    $tpl->assign('num4',$num4."--->{$_num4}%");
    $tpl->assign('num5',$num5."--->{$_num5}%");
    $tpl->assign('num6',$num6."--->{$_num6}%");
    $tpl->assign('all',$all);
    
    $tpl->assign('data',$data);
    $tpl->assign('page',$page);
    $tpl->compile('click','admin'); 
?>
