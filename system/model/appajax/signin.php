<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $signinsets = $db->query('signinset','','','id asc');
    $tel = CW('post/tel');
    $days = $db->query('users','days',"tel='{$tel}'",'id asc',1);
    $days = $days[0]['days'];
    $day = 0;
    $data = array();
    foreach ($signinsets as $signinset){
        $reward = $signinset['reward'];
        $day++;
        if($signinset['rewardtype']=='1'){
            $img = 'gift.png';
            $text = $reward.'个金币';
        }elseif ($signinset['rewardtype']=='2') {
            $img = 'post_operating_reward.png';
            $text = $reward.'元红包';
        }else{
            $img = $text = '';
        }
        if($day==3){
            $img = 'gift1.png';
            $text = '神秘礼品';
        }elseif($day==5){
            $img = 'gift2.png';
            $text = '神秘礼品';
        }elseif($day==7){
            $img = 'gift3.png';
            $text = '神秘大礼';
        }
        if($day<=$days){
            $style = "style='background:#cfcfcf'";
        }else{
            $style = '';
        }
        array_push($data,array(
            'day'=>$day, 
            'img'=>$img,
            'text'=>$text
        ));
	
    }
    echo json_encode(array(
        'data'=>$data
    ));
?>