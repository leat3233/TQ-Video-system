<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    
    $where = "";
    $count = $db->get_count('app',$where,'id'); 
    $pagecount = ceil($count/PAGESIZE);
    $page = CW('get/page',1);
    
    $page = $page<=0 ? 1 : $page;
    $page = $page>=$pagecount ? $pagecount : $page;
    $page = ($page-1)<0 ? 0 : ($page-1)*PAGESIZE;
    
    

    $apps = $db->query('app','',$where,'id desc',"{$page},".PAGESIZE);
    $data = '';
    foreach ($apps as $app){
		$data .= "<tr>
            		<td><input class='category_input' name='name' placeholder='APP应用名称' value='{$app['name']}'></td>
            		<td><input class='category_input' name='desces' placeholder='APP应用描述' value='{$app['desces']}'></td>
            		<td><input class='category_input' name='num' placeholder='热度' value='{$app['num']}'></td>
            		<td><input class='category_input' name='downloadurl' placeholder='APP应用下载页面地址' value='{$app['downloadurl']}'></td>
            		<td>
                    	<div class='upload'>
                    		<form class='test' method='post' enctype='multipart/form-data'>
                        		<p>
                        			<a class='rel btn btn3' href='javascript:;'><i class='fa fa-file-photo-o'></i><input name='file' type='file'>选择</a>
                        		</p><input placeholder='请选择图片' class='css' mode='upload' name='cover' value='{$app['cover']}'>
                        		<a class='btn btn1 upload' href='javascript:;'><i class='fa fa-cloud-upload'></i>上传</a>
                    		</form>
                    	</div>
                    </td>
                    <td>
                    	<a class='btn btn2' rel='updateapp' appid='{$app['id']}' href='javascript:;'><i class='fa fa-edit'></i>更新</a>
            		</td>
                </tr>";
    }
    
    $pageurl = INDEX.'/admin.php?mod=addapp&page=';
    $page = functions::page($count,$pagecount,$pageurl);

    $tpl =  new Society();
    $tpl->assign('data',$data);
    $tpl->assign('page',$page);
    $tpl->compile('advapp','admin'); 
?>