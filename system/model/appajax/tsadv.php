<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $advid = CW('post/id');
    $platform = CW('post/platform');
   
    $user = $db->query('sharelevel','tel',"tel2='{$tel}'",'',1)[0]['tel'];
    $position = $db->query('adv','position',"id='{$advid}'",'',1)[0]['position'];
    $db->exec('click','i',array(
        'tel'=>$tel,
        'dailiuser'=>$user ? $user : '',
        'advid'=>$advid,
        'position'=>$position,
        'platform'=>$platform,
        'ftime'=>time()
    ));

?>