<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
    $db = functions::db();
	if(!$id){
		msg('ID不存在,请返回列表重新操作','刷新','','',true);
	}
	$old = $db->query('users','tel,viptime,diam',"id='{$id}'",'',1);
	$viptime_old = $old[0]['viptime'];
    $diam_old = $old[0]['diam'];
    $nickname = CW('post/nickname');
    if(strlen($nickname)>18 || strlen($nickname)<3){
    	msg('标题字符要求为3~18','刷新','','',true);
    }
    $tel = CW('post/tel');
    // if(strlen($tel)!=11){
    // 	msg('电话号码必须为11位','刷新','','',true);
    // }
    
    $days = CW('post/days');
    if($days>7 || $days<0){
    	msg('签到天数范围为1-7','刷新','','',true);
    }
    $card = CW('post/card');
    $diam = CW('post/diam');
    $money = CW('post/money');
    $viptime = CW('post/viptime');
    $sex = CW('post/sex');
    $withdrawalspass = CW('post/withdrawalspass');
    $lockpass = CW('post/lockpass');
    $desc = CW('post/descs');
    $freeze = CW('post/freeze');
    $strtime = strtotime($viptime);
    $mylevel = intval(CW('post/mylevel'));
    if($mylevel>7){
        msg('星标设置错误!','刷新','javascript:location.reload()','notice',true);
    }
    if($strtime>time()){
        $level = 1;
    }else{
        $level = 0;
    }
    if($mylevel){
        $level = $mylevel;
    }
    if($level>0 && $strtime<time()){
        msg('设置星标后, VIP时间必须大于当前时间!','刷新','javascript:location.reload()','notice',true);
    }
    
    $update = array(
    	'nickname'=>$nickname,
    	//'tel'=>$tel,
    	//'card'=>$card,
    	'diam'=>$diam ? intval($diam) : 0,
    	'money'=>$money ? intval($money) : 0,
    	'viptime'=>$viptime ? strtotime($viptime) : 0,
    	'sex'=>$sex,
    	'mylevel'=>$level,
    	'withdrawalspass'=>$withdrawalspass ? $withdrawalspass : '',
    	'lockpass'=>$lockpass ? $lockpass : '',
    	'days'=>$days,
    	'descs'=>$desc,
    	'new1'=>CW('gp/new1'),
    	'freeze'=>$freeze=='冻结' ? '1' : '0',
    );

    $res = $db->exec('users','u',array($update,array(
    	'id'=>$id	
    )));
    
   
    if($res){
        
        $new1 = $db->query('users','viptime,diam',"id='{$id}'",'',1);
        
        if($diam_old<$diam){
            $d = $diam-$diam_old;
            $db->exec('message','i',array(
                'tel'=>$old[0]['tel'],
                'ftime'=>time(),
                'mtype'=>'后台赠送',
                'desces'=>"您好，AK官方为您充值{$d}金币已到账，请注意查收。"
            ));
        }
        if($viptime_old!=strtotime($viptime)){
           
            $db->exec('message','i',array(
                'tel'=>$old[0]['tel'],
                'ftime'=>time(),
                'mtype'=>'后台赠送',
                'desces'=>"您好，AK官方为您充值的VIP已到账，当前结束时间为".date('Y-m-d H:i:s',$new1[0]['viptime'])
            ));
        }
        msg('更新成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('数据无变动!','重置','javascript:location.reload()','error',true);
    }
?>