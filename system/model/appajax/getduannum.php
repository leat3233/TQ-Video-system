<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('gp/tel');
    $vid = CW('gp/vid');
  
    $data = $db->query('post','',"id='{$vid}'",'',1);
    $sets = $db->query('sets','duannum','id=1');
    $set_duannum = $sets[0]['duannum'];
    $viptime = $usermsg = $db->query('users','',"tel='{$tel}'",'',1);
    $isvip = false;
    if($viptime[0]['viptime']>time()){
        $isvip = true;
    }
    
    $vipdiam = intval($data[0]['vipdiam']);
    $diam = intval($data[0]['diamond']);
    
    $pnum = $data[0]['pnum']+1;
    
    $exist = $db->query('buyrecord','',"tel='{$tel}'  and payid='{$vid}'");
    //file::debug($tel);
    //file::debug($vid);
    // 1. 用户非会员 2. 免费 计算次数
    if($diam==0 && !$isvip && !$exist){
        
        $uduannum = $usermsg[0]['duannum'];
        if($uduannum>=$set_duannum){
            echo json_encode(array(
                'state'=>'freeover',
                'data'=>$data
            ));return;
        }
        record($tel,$vid,$db);
        $db->exec('post','u',"pnum='{$pnum}',id='{$vid}'");
        $utime = date('Y/m/d',$usermsg[0]['looktime']);
        $ctime = date('Y/m/d',time());
        if($utime!=$ctime){
            $duannum = 1;
        }else{
            $duannum = $uduannum+1;
            $duannum = $duannum>=$set_duannum ? $set_duannum : $duannum;
        }
       
        $db->exec("users",'u',array(array(
            'duannum'=>$duannum,
            'looktime'=>time()
        ),array(
            'tel'=>$tel
        )));
        
        
        echo json_encode(array(
            'state'=>'',
            'num'=>$duannum,
            'data'=>$data
        ));
    }else{
        $tips = functions::gettips($data[0]['vipdiam'],$data[0]['diamond']);
        if($exist || ($isvip && $tips=='vip')){
            $tips = '';
        }
        record($tel,$vid,$db);
        $db->exec('post','u',"pnum='{$pnum}',id='{$vid}'");
        echo json_encode(array(
            'state'=>$tips,
            'data'=>$data
        ));
    }
    function record($dev,$vid,$db){
        if(!$vid){
            return;
        }
        $exist = $db->query('history','',"dev='{$dev}' and vid='{$vid}'",'',1);
        if(!$exist){
            $db->exec('history','i',array(
                'dev'=>$dev,
                'vid'=>intval($vid)
            ));
            
        }
    }
?>