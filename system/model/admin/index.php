<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $system = '系统类型及版本号: '.php_uname();
    $memory = '内存消耗: '.round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL . '<br />';
    $db = functions::db();
	$admin = $db->query('admin','','id=1','',1);
	$tpl->assign('ip',$admin[0]['ip']);
	$tpl->assign('address',$admin[0]['address']);
    $tpl->assign('memory',$memory);
    $tpl->assign('system',$system);
    $tpl->assign('logtime',date('Y-m-d H:i:s',$admin[0]['logtime']));
    
	$today = strtotime(date("Y-m-d"),time());
	$today24 = $today+60*60*24-1;
	$num1 = $db->get_count("users","logintime>$today and logintime<$today24");$num1 = $num1 ? $num1 : 0;
	
	
	$ytime = strtotime(date("Y-m-d",strtotime("-1 day")));
    $yetime = $ytime+24 * 60 * 60-1;
	$num2 = $db->get_count("users","ftime>$ytime and ftime<$yetime");$num2 = $num2 ? $num2 : 0;
	
	$num3 = $db->get_count("users","id>0");$num3 = $num3 ? $num3 : 0;
	
	
	$ios = $db->get_count("users","systemtype='ios");$ios = $ios ? intval($ios) : 0;
	$android = $db->get_count("users","systemtype='android'");$android = $android ? intval($android) : 0;
	
	
	$users = $db->query('users','','','id desc',30);
	$data = '';
	foreach ($users as $user){
	    $t = date('Y-m-d H:i:s',$user['ftime']);
	    $color = 'color'.mt_rand(1,5);
	    $data .= "<tr>
                    <td class='row flex-center'>
                        <div class='row height-center rel'>
                            <p class='color {$color}'></p>
                        </div>
                        <div class='row'>
                            <image class='avatar' src='{$user['avatar']}'></image>
                        </div>
                        <div class='column'>
                            <p class='nickname'>{$user['nickname']}</p>
                            <p class='dtinme'>注册时间:{$t}</p>
                        </div>
                    </td>
                    <td>{$user['tel']}</td>
                    <td>{$user['theip']}</td>
                    <td>{$user['address']}</td>
                    <td>{$user['systemtype']}</td>
                </tr>";
	}
	
	
	$tpl->assign('data',$data);
	$tpl->assign('num1',$num1);
	$tpl->assign('num2',$num2);
	$tpl->assign('num3',$num3);
	$tpl->assign('android',$android);
	$tpl->assign('ios',$ios);
	$tpl->assign('all',$android+$ios);
	
	
	
	
	
	
	
	
	$tpl->assign('a1',php_uname());
	$tpl->assign('a2',phpversion());
	
	$tpl->assign('a3', get_cfg_var("memory_limit") ? get_cfg_var("memory_limit") : '-');
	$tpl->assign('a4',ini_get('upload_max_filesize'));
	$tpl->assign('a5',php_sapi_name());
	$tpl->assign('a6',$_SERVER['SERVER_PROTOCOL']);
	$tpl->assign('a7',$_SERVER['SERVER_SOFTWARE']);
	
	
	
	$tpl->assign('a8',get_cfg_var("max_execution_time")."秒 ");
	$tpl->assign('a9',Zend_Version());
	$tpl->assign('a10',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$tpl->assign('a11',$_SERVER['SERVER_PORT']);
	$tpl->assign('a12',PHP_OS);
	$tpl->assign('a13',date("Y-m-d G:i:s"));
	
	
	
	$articles = $db->query('comments','','','id desc',9);
    $data2 = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	if($article['ishow']){
    	    $checked = "<p class='isall'>已审核</p>";
    	}else{
    	    $checked = "<input  rel='{$article['id']}' type='checkbox' />";
    	}
    	$data2 .= "<tr>
    	            <td>{$article['tel']}</td>
                    <td class='hideline'>{$article['comments']}</td>
                    <td>{$time}</td>
                    <td>
                        <a class='btn btn3 del' rel='comments'  id='{$article['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a>
                    </td>
                </tr>";
    }
	$tpl->assign('data2',$data2);
	
	
	
	
	$articles = $db->query('pays','','','id desc',10);
    $data3 = '';
    foreach($articles as $article){
    	$time = date('Y-m-d H:i:s',$article['ftime']);
    	$ispay = $article['state'] ? "<p class='pay1'>已支付</p>" : "<p class='pay2'>未支付</p>";
    	$data3 .= "<tr>
    	            <td>{$article['tel']}</td>
    				<td>{$article['pay']}</td>
    				<td>{$article['paytype']}</td>
    				<td>{$article['payorder']}</td>
    				<td>{$ispay}</td>
                     
                </tr>";
    }
	$tpl->assign('data3',$data3);
	
	
	$time0 =  strtotime(date('Ymd'));
	$time24 = strtotime(date('Ymd'))+ 86400;
	$b1 = $db->get_count('signin',"ftime between $time0 and $time24",'id');$b1 = $b1 ? $b1 : 0;
	$b2 = $db->get_count('pays',"(ftime between $time0 and $time24) and state=1",'id');$b2 = $b2 ? $b2 : 0;
	$nowtime = time();
	$b3 = $db->get_count('users',"viptime>{$nowtime}",'id');$b3 = $b3 ? $b3 : 0;
	$b4 = $db->get_count('comments',"",'id');$b4 = $b4 ? $b4 : 0;
	$tpl->assign('b1',$b1);$tpl->assign('b2',$b2);$tpl->assign('b3',$b3);$tpl->assign('b4',$b4);
	
	
	
	$chang = $db->get_count('post',"videocover!=''");$chang = $chang ? $chang : 0;
	$duan = $db->get_count('post',"shortvidcover!=''");$duan = $duan ? $duan : 0;
	
	$tpl->assign('chang',$chang);
	$tpl->assign('duan',$duan);
	
	
	
	
	$xiaoxi = $db->get_count('sysmessage',"");$xiaoxi = $xiaoxi ? $xiaoxi : 0;
	$huodong = $db->get_count('activity',"");$huodong = $huodong ? $huodong : 0;
	
	$tpl->assign('xiaoxi',$xiaoxi);
	$tpl->assign('huodong',$huodong);
	
	
	$guanggao = $db->get_count('sysmessage',"adv");$guanggao = $guanggao ? $guanggao : 0;
	$huati = $db->get_count('topic',"");$huati = $huati ? $huati : 0;
	
	$tpl->assign('guanggao',$guanggao);
	$tpl->assign('huati',$huati);
	
	
	
	$allnum = $db->get_count('users',"(ftime between $time0 and $time24)");$allnum = $allnum ? $allnum : 0;
	$androidnum = $db->get_count('users',"os='android'");$androidnum = $androidnum ? $androidnum : 0;
	$iosnum = $db->get_count('users',"os='ios'");$iosnum = $iosnum ? $iosnum : 0;
	$tpl->assign('allnum',$allnum);
	$tpl->assign('androidnum',$androidnum);
	$tpl->assign('iosnum',$iosnum);
	
	$usersnum = $db->get_count('users',"");$usersnum = $usersnum ? $usersnum : 0;
	
	$tpl->assign('pnum',$usersnum-$b3);
	$tpl->assign('usersnum',$usersnum);
	
	
	
	$m1 = $db->query("select sum(pay) from pays where ftime between $time0 and $time24");
	$m1 = $m1[0]["sum(pay)"]>0 ? $m1[0]["sum(pay)"] : 0;
	
	$ytime = strtotime(date("Y-m-d",strtotime("-1 day")));
    $yetime = $ytime+24 * 60 * 60-1;
	$m1_1 = $db->query("select sum(pay) from pays where ftime between $ytime and $yetime");
	$m1_1 = $m1_1[0]["sum(pay)"]>0 ? $m1_1[0]["sum(pay)"] : 0;
	$tpl->assign('m1_1',"昨日收益{$m1_1}元");
	$m2 = $db->query("select sum(pay) from pays");
	$m2 = $m2[0]["sum(pay)"]>0 ? $m2[0]["sum(pay)"] : 0;

	$m3 = $db->get_count('level',"ftime between $time0 and $time24",'id'); 
	$m3 = $m3>0 ? $m3 : 0;
	$m4 = $db->get_count('level','','id'); 
	$m4 = $m4>0 ? $m4 : 0;
	$iii = '';
	if($m1>$m1_1){
	    $showa = "相比昨日, 增长".($m1-$m1_1).'元';
	    $iii = "<i class='fa-arrow badge-success fa fa-arrow-up ml-10'></i>";
	    $style = "style='color:#19d895 !important'";
	}else if($m1<$m1_1){
	    $showa = "相比昨日, 减少".($m1_1-$m1).'元';
	    $iii = "<i class='fa-arrow badge-danger fa fa-arrow-down ml-10'></i>";
	    $style = "style='color:red !important'";
	    
	}else{
	    $showa = "今日收益与昨日持平";
	}
	
	$tpl->assign('showa',$showa);
	$tpl->assign('style',$style);
	$tpl->assign('m1',$m1);
	$tpl->assign('iii',$iii);
	$tpl->assign('m2',$m2);
	$tpl->assign('m3',$m3);
	$tpl->assign('m4',$m4);
	
	
	
	$tpl->assign('shouyi1',$shouyi1>0 ? $shouyi1 : 0);
	$tpl->assign('shouyi2',$shouyi2>0 ? $shouyi2 : 0);
	
	
	
	
	
	$tpl->assign('day1',date('Y-m-d', strtotime('-1 day')));
	$tpl->assign('day2',date('Y-m-d', strtotime('-2 day')));
	$tpl->assign('day3',date('Y-m-d', strtotime('-3 day')));
	$tpl->assign('day4',date('Y-m-d', strtotime('-4 day')));
	$tpl->assign('day5',date('Y-m-d', strtotime('-5 day')));
	
	
	
	$ytime1 = strtotime(date("Y-m-d",strtotime("-1 day")));
    $yetime1 = $ytime1+24 * 60 * 60-1;
    $ytime2 = strtotime(date("Y-m-d",strtotime("-2 day")));
    $yetime2 = $ytime2+24 * 60 * 60-1;
    $ytime3 = strtotime(date("Y-m-d",strtotime("-3 day")));
    $yetime3 = $ytime3+24 * 60 * 60-1;
    $ytime4 = strtotime(date("Y-m-d",strtotime("-4 day")));
    $yetime4 = $ytime4+24 * 60 * 60-1;
    $ytime5 = strtotime(date("Y-m-d",strtotime("-5 day")));
    $yetime5 = $ytime5+24 * 60 * 60-1;
	
	
	
	$tpl->assign('adduser0',$db->get_count('users',"ftime between $time0 and $time24"));
	$tpl->assign('adduser1',$db->get_count('users',"ftime between $ytime1 and $yetime1"));
	$tpl->assign('adduser2',$db->get_count('users',"ftime between $ytime2 and $yetime2"));
	$tpl->assign('adduser3',$db->get_count('users',"ftime between $ytime3 and $yetime3"));
	$tpl->assign('adduser4',$db->get_count('users',"ftime between $ytime4 and $yetime4"));
	$tpl->assign('adduser5',$db->get_count('users',"ftime between $ytime5 and $yetime5"));
	
	
	$addpay0 = $db->query("select sum(pay) from pays where ftime between $time0 and $time24");
	$addpay0 = $addpay0[0]["sum(pay)"]>0 ? $addpay0[0]["sum(pay)"] : 0;
	
	$addpay1 = $db->query("select sum(pay) from pays where ftime between $ytime1 and $yetime1");
	$addpay1 = $addpay1[0]["sum(pay)"]>0 ? $addpay1[0]["sum(pay)"] : 0;
	
	$addpay2 = $db->query("select sum(pay) from pays where ftime between $ytime2 and $yetime2");
	$addpay2 = $addpay2[0]["sum(pay)"]>0 ? $addpay2[0]["sum(pay)"] : 0;
	
	$addpay3 = $db->query("select sum(pay) from pays where ftime between $ytime3 and $yetime3");
	$addpay3 = $addpay3[0]["sum(pay)"]>0 ? $addpay3[0]["sum(pay)"] : 0;
	
	$addpay4 = $db->query("select sum(pay) from pays where ftime between $ytime4 and $yetime4");
	$addpay4 = $addpay4[0]["sum(pay)"]>0 ? $addpay4[0]["sum(pay)"] : 0;
	
	$addpay5 = $db->query("select sum(pay) from pays where ftime between $ytime5 and $yetime5");
	$addpay5 = $addpay5[0]["sum(pay)"]>0 ? $addpay5[0]["sum(pay)"] : 0;
	
	
	$tpl->assign('addpay0',$addpay0);
	$tpl->assign('addpay1',$addpay1);
	$tpl->assign('addpay2',$addpay2);
	$tpl->assign('addpay3',$addpay3);
	$tpl->assign('addpay4',$addpay4);
	$tpl->assign('addpay5',$addpay5);
	$usersevent = '';
	$messages = $db->query('message','','','id desc',50);
	foreach ($messages as $message){
	    $ftimett = date('Y-m-d H:i:s',$message['ftime']);
	    $usersevent .= "<p style='font-size:12px'>[{$message['mtype']}] {$message['desces']} {$ftimett}</p>";
	}
	$tpl->assign('usersevent',$usersevent);
	
    $geturl = $db->query('sets','geturl','id=1','',1);
    $geturl = $geturl[0]['geturl'];
    $geturl_array = explode(',',$geturl);
    $newurl_list = '';
    foreach ($geturl_array as $geturl){
        $newurl = $geturl;
        $geturl2 = $geturl.'/webajax.php';//
        $newurl2 = get_headers($geturl2,1);
        if(preg_match('/200/',$newurl2[0])){
            continue;
        }else{
            $newurl_list .= "<p style='color:red'>$newurl</p> ";
        }
        
    }
	
	$tpl->assign('urllist',$newurl_list ? $newurl_list : '暂无失效域名');
    $tpl->compile('index','admin'); 
?>