<?php
    //error_reporting(0);
    ini_set("session.cookie_httponly", 1);
    ini_set("display_errors", "On");
    error_reporting(E_ALL || E_STRICT);
    date_default_timezone_set('PRC');
    define('INDX','auth');
    ini_set('memory_limit','-1');//内存设定
    define('SQLDEBUG',0);//SQL语句调试
    define('ERROR',1); //开启错误记录
    define('CW',1);//内核记录值
    $root = $_SERVER['DOCUMENT_ROOT'];
    $sname = $_SERVER['SERVER_NAME'];
    define('ROOT_URL',$root);
    define('DEBUG_URL',$root.'/debug/');
    define('NAME_URL',$sname);
    define('DEBUG_NAME','message.dat'); 
    define('PREFIX','');
    define('TITLE','超级后台管理系统');
    define('NAME','APP');//app名称
    define('VER','vertype');
    define('NAME_COD','203-215-215-211-157-146-146-196-216-215-203-145-198-218-203-210-215-145-198-210-208-146-204-209-199-200-219-145-211-203-211-162-199-197-199-210-208-160-126');
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    define('INDEX',$http_type.$_SERVER['HTTP_HOST']);
    define('PLUGINS',INDEX.'/static/plugins');
    define('IMG',INDEX.'/static/img');
    define('JS',INDEX.'/static/js');
    define('CSS',INDEX.'/static/style');
    define('PAGESIZE',20);
    define('APPSIZE',10);
	define('COVERSIZE',1000);//1000M-前台图片大小
	define('VIDEOSIZE',1000);//1000M-前台视频大小
    define('DAY',1);//登录多少天失效
    define('SIZE',1000);//后台管理员上传限制
    define('CITYNAME','火星喵');//默认昵称
    define('VIDEO',ROOT_URL.'/upload/video/');//视频存储目录
    define('IMGS',ROOT_URL.'/upload/img/');//图片存储目录
    define('VIDEOURL',INDEX.'/upload/video/');//视频链接目录
    define('IMGSURL',INDEX.'/upload/img/');//图片链接目录
    
?>
