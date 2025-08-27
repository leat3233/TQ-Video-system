<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('gp/tel');
    $vid = CW('gp/id');
    record($tel,$vid,$db);
    $data = $db->query('post','',"id='{$vid}'",'',1);
    ///////////////////////////////////////////////////
    $sets = $db->query('sets','changnum','id=1');
    $set_changnum = $sets[0]['changnum'];
    $viptime = $usermsg = $db->query('users','',"tel='{$tel}'",'',1);
    $isbind = $usermsg[0]['usertel'] ? true : false;
    $isvip = false;
    if($viptime[0]['viptime']>time()){
        $isvip = true;
    }
    $vipdiam = intval($data[0]['vipdiam']);
    $diam = intval($data[0]['diamond']);
    $exist = $db->query('buyrecord','',"tel='{$tel}'  and payid='{$vid}'");
    // 1. 用户非会员 2. 免费 计算次数
    if($diam==0 && !$isvip && !$exist){
        $uchangnum = $usermsg[0]['changnum'];
        if($uchangnum>=$set_changnum){
            echo json_encode(array(
                'isbind'=>$isbind,
                'state'=>'freeover',
                'video'=>$data,
                'isvip'=>$isvip,
                'vidisvip'=>$vipdiam==0 ? 'vip' : 'notvip',
                'cover'=>$data[0]['videocover'],
                'url'=>$data[0]['videourl']
            ));return;
        }
        $utime = date('Y/m/d',$usermsg[0]['looktime']);
        $ctime = date('Y/m/d',time());
        if($utime!=$ctime){
            $changnum = 1;
        }else{
            $changnum = $uchangnum+1;
        }
       
        $db->exec("users",'u',array(array(
            'changnum'=>$changnum,
            'looktime'=>time()
        ),array(
            'tel'=>$tel
        )));
    }
    ///////////////////////////////////////////////////
    $pnum = $data[0]['pnum']+1;
    $db->exec('post','u',"pnum='{$pnum}',id='{$vid}'");
    $isbuy = $db->query('sellvideo','',"tel='{$tel}' and vidid='{$vid}'",'',1);
    if($isbuy){
        echo json_encode(array(
            'isbind'=>$isbind,
            'state'=>'iscan',
            'video'=>$data,
            'isvip'=>$isvip,
            'vidisvip'=>$vipdiam==0 ? 'vip' : 'notvip',
            'cover'=>$data[0]['videocover'],
            'url'=>$data[0]['videourl']
        ));return;
    }
    
    
    
    
    
    
    if($isvip && $vipdiam===0){
        echo json_encode(array(
            'isbind'=>$isbind,
            'state'=>'iscan',
            'video'=>$data,
        'isvip'=>$isvip,
        'vidisvip'=>$vipdiam==0 ? 'vip' : 'notvip',
        'cover'=>$data[0]['videocover'],
        'url'=>$data[0]['videourl']
        ));return;
    }
    if($data && $diam===0){
        echo json_encode(array(
            'isbind'=>$isbind,
            'state'=>'iscan',
            'video'=>$data,
        'isvip'=>$isvip,
        'vidisvip'=>$vipdiam==0 ? 'vip' : 'notvip',
        'cover'=>$data[0]['videocover'],
        'url'=>$data[0]['videourl']
        ));return;
    }
    echo json_encode(array(
        'isbind'=>$isbind,
        'state'=>'notcan',
        'video'=>$data,
        'isvip'=>$isvip,
        'vidisvip'=>$vipdiam==0 ? 'vip' : 'notvip',
        'cover'=>$data[0]['videocover'],
        'url'=>$data[0]['videourl']
    ));
    function record($dev,$vid,$db){
        $exist = $db->query('history','',"dev='{$dev}' and vid='{$vid}'",'',1);
        if(!$exist){
            $db->exec('history','i',array(
                'dev'=>$dev,
                'vid'=>intval($vid)
            ));
            
        }
    }
?>