<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $share = CW('gp/m');//父用户
    $sole = CW('post/sole');//设备号
    $encoded = CW('post/encoded');
    if($encoded){
        $tel = functions::autocode($tel,'-');
    }
    
    $data = $db->query('users','',"(tel='{$tel}' and tel!='') || (sole='{$sole}' && sole!='')",'id asc',1);
   
    //$data = $db->query('users','',"tel='{$tel}'",'id asc',1);
    if(CW('post/dele')){
        $data[0]['id'] = '';
    }
    if(!$data[0]['id']){
       
        $isexist = false;
    	do {
    		$card = mt_rand(100000000,999999999);
    		$isexist = $db->query('users','id',"card='{$card}'");
    	} while ($isexist);
    	
    	    $user = $db->query('sets','desces,nickname','id=1');
            $array = explode('|',$user[0]['nickname']);
            $nickname = $array[array_rand($array,1)];
            $avatar = '../../static/avatar/icon_avatar_'.mt_rand(1,17).'.png';
            $descs = $user[0]['desces'];

            if($share){
                if(strstr($share, 'v')){
                    $new_share = ltrim($share,'v');
                   
                    $isexistfu = $db->query('users','',"tel='{$new_share}'",'',1);
                    $isdaili = $db->query('dluser','',"tel='{$new_share}'",'',1);
                    $isexistsole = $db->query('sharelevel','',"tel='{$new_share}' and tel2='{$card}'",'',1);
                    if($isexistfu && $isdaili && !$isexistsole){
                        functions::intobroker2($new_share,$card,time(),$sole);
                    }
                }else{//邀请送VIP
                    $isexistfu = $db->query('users','',"tel='{$share}'",'',1);
                    $isexistsole2 = $db->query('level','id',"tel='{$share}'   and dev='{$sole}'",'',1);
                    if($isexistfu[0]['id'] && !$isexistsole2[0]['id']){
                        functions::intobroker($share,$card,time(),$sole);
                    }
                }
            }


            
                
            
    	
        
        //$ip = CW('post/ip');
        // $sharecard = CW('post/card');
        // $exist = $db->query('share','',"ip='{$ip}' and card='{$sharecard}' and state=1");
        // if($exist){
        //     $db->exec('share','u',array(array(
        //         'state'=>0    
        //     ),array(
        //         'ip'=>$ip,
        //         'cid'=>$cid,
        //         'cname'=>$cname,
        //         'card'=>$sharecard
        //     )));
        //     $prevtel = $db->query('users','tel',"card='{$sharecard}'",'',1);
        //     $prevtel = $prevtel[0]['tel'];
        //     $time = time();
        //     if($prevtel){
        //         functions::intobroker($prevtel,$dev,$time,1);
        //     }
        // }
        //---end
        $res = $db->exec('users','i',array(
            'nickname'=>$nickname,
            'avatar'=>$avatar,
            'diam'=>0,
            'card'=>$card,
            'tel'=>$card,
            'sole'=>$sole ? $sole : $card.mt_rand(100,99999999999),
            'theip'=>$ip,
            'address'=>$address ? $address : CITYNAME,
            'descs'=>$descs,
            'ftime'=>time(),
            'logintime'=>time(),
            'systemtype'=>$systemtype ? $systemtype : '未知',
            'systemversion'=>$systemversion ? $systemversion : '未知',
            'os'=>$os ? $os : '未知',
        ));
        if($res){
            echo json_encode(array(
                'nickname'=>$nickname, 
                'avatar'=>$avatar,
                'descs'=>$descs,
                'tel'=>$card,
                'state'=>1,
                'ftime'=>time()
            ));
        }else{
            echo json_encode(array(
                'err'=>'数据库异常,请稍后再试!'
            ));
        }
    }else{
        if($data[0]['viptime']<time()){
            $db->exec("update users set mylevel=0 where tel='{$tel}'");
        }
        //$logintime = time();
        //$db->exec("update users set logintime='{$logintime}' where card='{$data[0]['card']}'");
        $viptime = $data[0]['viptime'];
        if(!$viptime){
            $viptime = '未开通';
        }else if($viptime<time()){
            $viptime = '已过期';
        }else{
            $viptime = date('Y-m-d',$viptime);
        }
        echo json_encode(array(
            'nickname'=>$data[0]['nickname'],
            'avatar'=>$data[0]['avatar'],
            'card'=>$data[0]['card'],
            'descs'=>$data[0]['descs'],
            'tel'=>$data[0]['tel'],
            'state'=>1,
            'sex'=>$data[0]['sex'],
            'money'=>$data[0]['money'],
            'mylevel'=>$data[0]['mylevel'],
            'diam'=>$data[0]['diam'],
            'withdrawalspass'=>$data[0]['withdrawalspass'],
            'card'=>$data[0]['card'],
            'viptime'=>$viptime,
            'state'=>1
        ));
    }
    

?>