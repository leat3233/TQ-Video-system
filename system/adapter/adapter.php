<?php  
/**
 * CW('get/mod') 获取去html标签的变量
 * CW('get/mod',1) 获取自定义过滤后的变量  * 过滤格式 0.获取参数 1.保留数字 2.保留小写字母 3.保留数字+小写字母+_4.保留中文
 */
if(!defined('CW')){exit('Access Denied');}
function CW($var,$num=0) {
    $var = trim($var);
    $vars = array(
        'get' => array_merge($_GET, $_POST),
        'post' => array_merge($_GET, $_POST),
        'gp' => array_merge($_GET, $_POST),
        //'server' => $_SERVER,
        //'env' => $_ENV,
        //'request' => $_REQUEST,
        'file' => $_FILES,
        'cookie' => $_COOKIE,
        //'session' => $_SESSION
    );
    $var = explode('/',$var);
    $get = $var[1] ? $vars[$var[0]][$var[1]] : $vars[$var[0]];
    if(is_array($get)){
        return $get;
    }
    if($num==0){
        return htmlentities(strip_tags($get),ENT_QUOTES,'UTF-8');
    }elseif($num==1 || $num==2 || $num==3 || $num==4){
        return filter($num,'',$get);
    }elseif($num==5){
        return $get;
    }else{
        return 'parameter error';
    }
}
/**
 * 正则序列(从1开始) - 替换字符串 - 参数
 */
 /*
function rem($data=CODE){
    $temp = '';
    $data = strval($data);
    $seed = intval(substr(strrchr($data,'-'),1));
    $seed = $seed-27;
    $code = explode('-',$data);
    array_pop($code);
    for($i=0;$i<count($code);$i++){$password .= chr(intval($code[$i])-$seed);}
    return strval($password);
}*/
function filter($type,$convert='',$object){
    $preg = array(
        '/[^\d]/',//保留数字
        '/[^a-z#]/',//保留小写字母
        '/[^\w]/',//保留数字+小写字母+_
        '/[^\x{4e00}-\x{9fa5}]/u',//保留中文
    );
    return preg_replace($preg[intval($type)-1],$convert,$object);
}
/**
 * 框架内置弹窗
 * msg -> 弹窗内容
 * name -> 按钮名字
 * url -> 链接
 * */
function msg($msg,$name,$url=false,$type='notice',$cancel=false){


    if($type=='success'){
        $type = 'fa-check-circle';
    }elseif($type=='error'){
        $type = 'fa-times-circle';
    }else{
        $type = 'fa-exclamation-circle';
    }

    $tpl = new Society();
    $tpl->assign('type',$type);
    $tpl->assign('name',$name);
    if($url){
    	$tpl->assign('url',$url);
    }else{
    	$tpl->assign('url',"javascript:location.reload()");
    }
    
    $tpl->assign('msg',$msg);
    if($cancel){
    	$tpl->assign('cancel',"<a class='toastclose' href='javascript:;'>关闭</a>");
    }
    
    $tpl->compile('window','window'); 
    $vars = get_defined_vars();
    unset($vars);
    exit;
}

function logincheck(){
    $islogin = functions::autocode(CW('cookie/__secret'),'-');
    if($islogin!='islogin'){
        functions::url(INDEX.'/admin.php?mod=login');
    }
}

?>