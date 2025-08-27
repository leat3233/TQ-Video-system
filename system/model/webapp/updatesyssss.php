<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $look = CW('post/look');
    $greenhorn = CW('post/greenhorn');
    $customer = CW('post/customer');
   
    $res = $db->exec('sets','u',array(
        array(
           'g1'=>CW('post/g1'),
           'g2'=>CW('post/g2'),
           'g3'=>CW('post/g3'),
           'g4'=>CW('post/g4')
        ),array(
            "id"=>1
        )));
   
    if(CW('post/open')=='on'){
        
        $suiji = explode('|',CW('post/g1'));
        $rand1 = $suiji[0];
        $rand2 = $suiji[1];
        $num = mt_rand($rand1,$rand2);
        for ($i = 0; $i < $num; $i++) {
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
            $db->exec('users','i',array(
                'nickname'=>$nickname,
                'avatar'=>$avatar,
                'diam'=>0,
                'card'=>$card,
                'tel'=>$card,
                'sole'=>'',
                'theip'=>'',
                'address'=>'火星喵',
                'descs'=>$descs,
                'ftime'=>time(),
                'logintime'=>time(),
                'systemtype'=>'',
                'systemversion'=>'',
                'os'=>'',
                'xn'=>1
            ));
        }
        msg('已成功生成'.$num.'个虚拟用户!','确定','','success');
    }else{
        msg('设置成功!','确定','','success');
    }
   
   
   
    //if($res){
    	
    //}else{
    //    msg('数据无变动!','重填','javascript:location.reload()','',true);
    //}
?>