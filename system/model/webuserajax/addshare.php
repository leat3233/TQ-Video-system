<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $user = CW('post/tel');
    $lv = CW('post/lv');
    if(!$user || !$lv){
        msg('每项必填并且用户分成比例不得为0!','重置','javascript:location.reload()','error',true);
    }
    $db = functions::db();
    $father = CW('post/father');
    if($user==$father){
        msg('代理用户名不可填写自己的!','重置','javascript:location.reload()','error',true);
    }
   
    $father_lv = $db->query('share','lv',"son='{$father}'",'',1);
    $father_lv = $father_lv[0]['lv'];
    $exist = $db->query('users','',"tel='{$user}'",'',1);
    if(!$exist){
        msg('代理用户不存在,请检查!','重置','javascript:location.reload()','error',true);
    }
    $existdl = $db->query('share',"lv","father='{$user}'",'',1);
    if($existdl[0]['lv']>0){
        msg('代理用户名无效,该用户已经是代理,请更换!','重置','javascript:location.reload()','error',true);
    }
    if(!$father_lv){
        //msg('权限不足,无法开线!','重置','javascript:location.reload()','error',true);
    }
    if($father_lv<=$lv && $father_lv){
        msg('用户的分成比例不可超过自己!','重置','javascript:location.reload()','error',true);
    }
    $is = $db->query('share','',"father='{$father}' and son='{$user}'",'',1);
  
    if($is){
        $res = $db->exec('share','u',array(array(
            'father'=>$father,
            'son'=>$user,
            'lv'=>intval($lv),
        ),array(
            'id'=>CW('gp/id')    
        )));
        if($res){
            msg('操作成功!','刷新','javascript:location.reload()','success',true);
        }else{
            msg('数据无变动!','重置','javascript:location.reload()','error',true);
        } 
    }else{
        $res = $db->exec('share','i',array(
            'father'=>$father,
            'son'=>$user,
            'lv'=>intval($lv),
            'ftime'=>time()
        ));
        if($res){
            $db->exec("update users set dailipass='123456' where tel='{$user}'");
            $add = "代理登录地址:".INDEX.'/uplivepopo.php?mod=login'." 账号: $user 密码: 123456";
            msg("操作成功,{$add}",'刷新','javascript:location.reload()','success',true);
        }else{
            msg('数据无变动!','重置','javascript:location.reload()','error',true);
        } 
    }
    
    // if($res){
        
    // }else{
    //     msg('数据无变动!','重置','javascript:location.reload()','error',true);
    // } 
?>