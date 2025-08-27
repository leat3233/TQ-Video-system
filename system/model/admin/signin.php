<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

    $signinsets = $db->query('signinset','',$where,'id asc');
    $data = '';
    foreach ($signinsets as $signinset){
        if($signinset['rewardtype']=='1'){
            $v1 = 'selected';
            $v2 = '';
        }elseif ($signinset['rewardtype']=='2') {
            $v1 = '';
            $v2 = 'selected';
        }

		$data .= "<tr class='search'>
		            <td>第{$signinset['day']}天</td>
            		<td><select name='rewardtype'>
                        <option {$v1} value='1'>金币</option>
                        <option {$v2} value='2'>红包</option>
                    </select></td>
            		<td><input class='category_input' name='reward' placeholder='填写整数' value='{$signinset['reward']}'> 金币/红包</td>
            		
                    <td><a class='btn btn2' rel='updatesignin' id='{$signinset['id']}' href='javascript:;'><i class='fa fa-edit'></i>更新</a></td>
                </tr>";
    }

    $tpl =  new Society();
    $tpl->assign('data',$data);
    $tpl->compile('signin','admin'); 
?>