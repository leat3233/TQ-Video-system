<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $cards = $db->query('card','','','id desc');
    foreach ($cards as $card){
        if($card['cardtype']=='1'){
            $cardtype = '钻石';
            $res = $card['cardnum'].'钻石';
        }elseif ($card['cardtype']=='2') {
            $cardtype = '会员';
            $res = '会员'.$card['cardnum'].'天';
        }
        if(!$card['ishow']){
            $state = "<span class='alw'>未使用</span>";
        }else{
            $state = "<span class='aly'>已使用</span>";
        }
		$data .= "<tr>
            		<td><p>{$card['card']}</p></td>
            		<td><p>{$cardtype}</p></td>
            		<td><p>{$res}</p></td>
            		<td><p>{$state}</p></td>
            		<td><a class='btn btn3 del' rel='card' id='{$card['id']}' href='javascript:;'><i class='fa fa-trash'></i>删除</a></td>
                </tr>";
    }
    $tpl =  new Society();
    echo 'success';
?>