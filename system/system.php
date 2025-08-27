<?php
    if(!defined('CW')){exit('Access Denied');}
    class Society{
        function __construct(){
            $this->vars = array();
        }
        function assign($tpl_var,$var=''){
            if(!$tpl_var)return;
            if(is_array($tpl_var)){
                foreach($tpl_var as $key => $value){$this->vars[$key] = $value;}return;
            }else if(is_string($tpl_var)){
                $this->vars[$tpl_var] = $var;return;
            }else{return;}
        }
        /**
         * compile('filename','dir1-dir2-dir3');
         * 第二个参数不填写或者为空 表示是模板文件夹根目录
         **/
        function compile($fileName,$tpl_dir=''){
            !empty($tpl_dir) ? $tpl_dir = str_replace('-','/',$tpl_dir).'/' : $tpl_dir = '';
            $tplFile = ROOT_URL.'/templates/'.$tpl_dir.$fileName.'.html';
            if(!file_exists($tplFile)){
                $create_dir = ROOT_URL.'/templates/'.$tpl_dir;
                @file::mk_dir($create_dir);
                file_put_contents($tplFile,'');
            }
            $comFile = ROOT_URL.'/cache/'.$tpl_dir.basename($tplFile,'.html').'.php';
            if(!file_exists($comFile) || filemtime($comFile)<filemtime($tplFile)){
                @file::mk_dir(ROOT_URL.'/cache/'.$tpl_dir);
                $repContent  = $this->tpl_replace(file_get_contents($tplFile));
                $handle = fopen($comFile,'w+');
                fwrite($handle,$repContent);
                fclose($handle);
            }include($comFile);
            
        }
        function tpl_replace($content){
            $pattern = array(
               '/\{template\:model\:(\w+)\}/',//{template:model:header}
               '/\{template\:model\:admin\:(\w+)\}/',//{template:model:phone:header}
               '/\{template\:model\:daili\:(\w+)\}/',//{template:model:phone:header}
               '/\{G\:(\w+)\}/',//{G:ROOT_URL}
               '/\{CW\(\'(cookie|gp|get|post|server|env|request|files|session)\/(.*?)\'\)\}/',//{CW('cookie/cur_user')}
               '/\{(.*?)\}/',//{var}
               '/\<\?php (.*?) \?\>/'
            );
            $replacement = array(
                '<?php file::import("system-model-${1}"); ?>',
                '<?php file::import("system-model-admin-${1}"); ?>',
                '<?php file::import("system-model-daili-${1}"); ?>',
                '<?php echo ${1} ?>',//全局变量
                '<?php echo CW(\'${1}/${2}\');  ?>',//CW
                '<?php echo $this->vars["${1}"] ?>',
                '<?php ${1} ?>'
            );
            return preg_replace($pattern,$replacement,$content);
        }
    }
?>