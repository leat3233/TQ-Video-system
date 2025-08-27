<?php
    if(!defined('CW')){exit('Access Denied');}
    class file{
        /**
		* 导入文件 样式: import('system-library-file',false)
        * 起始路径: 根目录 
        * 第二参数 开启->true 为开发模式 自动生产文件
		**/ 
        static function import($indent,$dev = false){
            if(!$indent){self::debug("Invalid directory");return;}
            $dir = ROOT_URL.'/'.str_replace('-','/',$indent).'.php';
            $model = substr(stristr($indent,'-'),1,5);
            if($model=='model'){//scope
                $mod = substr(strrchr($indent,'-'),1);
                if(!file_exists($dir)){
                    if($dev==false){
                        die($dir.'不存在');
                        functions::url(INDEX.'/error.html');
                    }
                    $c_dir = substr($dir,0,strrpos($dir,'/'));
                    @self::mk_dir($c_dir);
                    $c_dir = str_replace('/','-',substr(strstr($c_dir,'model'),6));
                    file_put_contents($dir,'<?php 
if(!defined(\'CW\')){exit(\'Access Denied\');}
$tpl =  new Society();
$tpl->compile(\''.$mod.'\''.','.'\''.$c_dir.'\'); 
?>');
                }
            } 
            if(file_exists($dir)){
                include($dir);
            }
        }
        /**
         * 循环创建目录
         * temp1/temp2/temp3/temp4/
         **/
        static function mk_dir($dir){
            if(!file_exists($dir)){
                self::mk_dir(dirname($dir));
                mkdir($dir,0777);
                file_exists($dir.'/index.html') ? null : file_put_contents($dir.'/index.html','');
            }
        }
        /**
         * debug文件 - 错误显示
         **/
        static function debug($data,$filename=DEBUG_NAME,$url = DEBUG_URL){
            !file_exists($url) ? self::mk_dir($url) : null;
            file_put_contents($url."$filename","\n".'======================================================'."\n".date('Y-m-d H:i:s',time())."\n\n".$data."\n".'======================================================'."\n\n",FILE_APPEND);
        }
	}
?>