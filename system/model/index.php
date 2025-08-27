<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $db = functions::db();
    $set = $db->query('sets','','id=1');
  
    $tpl->assign('h51',$set[0]['h51']);
    $tpl->assign('h52',$set[0]['h52']);
    $tpl->assign('h53',$set[0]['h53']);
    $tpl->assign('h54',$set[0]['h54']);
    
    $h5 = $set[0]['h5'];
    $h5s = explode(',',$h5);
    $data = '';
    foreach ($h5s as $key=>$val){
        $key = $key+1;
        $url = "";
        $data .= "<div class='line-enter line-enter-1' >
<a href='{$val}' style='color:#fff' target='_blank'>
                    <div class='btn-enter c_ddd'>快速路线<span class='c_blue'>{$key}</span></div>

                    <p>立即进入</p></a>
                </div>";
    }
    
    $tpl->assign('data',$data);
    $tpl->compile('index',''); 
?>