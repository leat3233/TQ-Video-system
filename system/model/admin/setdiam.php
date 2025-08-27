<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

    $vipcards = $db->query('diamcard','',$where,'id desc');
    $data = '';
    foreach ($vipcards as $diam){
		$data .= "<tr>
            		<td><input class='category_input' name='diamnum' placeholder='购买获得的钻石数' value='{$diam['diamnum']}'></td>
            		<td><input class='category_input' name='give' placeholder='购买赠送的钻石, 不赠送填写0' value='{$diam['give']}'></td>
            		<td><input class='category_input' name='price' placeholder='价格' value='{$diam['price']}'></td>
            		<td><input class='category_input' name='descs' placeholder='描述,最多12字' value='{$diam['descs']}'></td>
            		<td><input class='category_input' name='tag' placeholder='右下角小标签' value='{$diam['tag']}'></td>
            		<td><a class='btn btn2' rel='updatediam' diamcardid='{$diam['id']}' href='javascript:;'><i class='fa fa-edit'></i>更新</a></td>
                </tr>";
    }
    $tpl =  new Society();
    $tpl->assign('data',$data);
    $tpl->compile('setdiam','admin'); 
?>