<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $topics = $db->query('topic','name');
    $data = '';
    foreach ($topics as $topic){
    	$data .="<li>{$topic['name']}</li>";
    }
    $tpl =  new Society();
    $id = CW('get/id');
    if($id){
        $post = $db->query('post','',"id='{$id}'",'',1);
        $tpl->assign('title',$post[0]['title']);
		$tpl->assign('shortvidcover',$post[0]['shortvidcover']);
		$tpl->assign('tel',$post[0]['userid']);
		$tpl->assign('shortvidurl',$post[0]['shortvidurl']);
		$tpl->assign('likes',$post[0]['likes'] ? $post[0]['likes'] : 0);
		$tpl->assign('diamond',$post[0]['diamond'] ? $post[0]['diamond'] : 0);
		$tpl->assign('vipdiam',$post[0]['vipdiam'] ? $post[0]['vipdiam'] : 0);

		
        $topic = explode(',',$post[0]['topic']);
		$d = '';
		foreach ($topic as $val){
			$name = $db->query('topic','name',"id='{$val}'",'',1);
			$d .= $name[0]['name'].'|';
		}
		$d = substr($d,0,strlen($d)-1);
		$tpl->assign('topic',$d);
        $tpl->assign('ishow',$post[0]['ishow']=='1' ? '公开' : '审核');
        $button = "<a href='javascript:;' class='btn submit' rel='updateshortvid'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $button = "<a href='javascript:;' class='btn submit' rel='addshortvideo'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
    
    $tpl->assign('data',$data);
    $tpl->assign('page',$page);
    $tpl->assign('button',$button);
    $tpl->compile('shortvideo','admin'); 
?> 