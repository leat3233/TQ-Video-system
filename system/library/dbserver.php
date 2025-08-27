<?php
    if(!defined('CW')){exit('Access Denied');}
    class dbserver {
		/**
		* 属性
		*/
		private $dbhost;
		private $dbuser;
		private $dbpw;
		private $dbname;
		private $dbc_msg;
        
        function __construct($args=array()){
			foreach($args as $name=>$value){
				$this->$name = $value;
			}
		}
        function __destruct() {
		  $this->dbc_msg = null;
        }
        
		/**
		* exec('表名','标识',一维/二维数组/字符串)   
        * 删除修改方法支持自由模式 条件等支持常规写法 
        * exec('update table set id=1');
        * add: exec('table','i',array('param1'=>'','param2'=>''));
        * update:exec('table','u',"user=$name,id=1"));
        * update:exec('table','u',array(array('set1'=>''),array('where'=>'')));
        * delete: exec('table','d','id=5');
        * delete: exec('table','d',array('param1'=>'',"param2"=>''));
		**/
		 function exec($tbname,$iden='',$params=''){
            if(func_num_args()==1){
                $sql = $tbname; 
		    }else{
                if(!in_array($iden,array('i','u','d'))){
                    if(ERROR){
                        file::debug('function:exec -> parameter(second) error','error.dat');
                    }
                    return;
                }
                if($iden == 'u'){
                    if(is_string($params)){
                        if(strstr($params,',')){
                            $pos = strpos($params,',');
                            $set = substr($params,0,$pos);
                            $where = 'where '.substr($params,$pos+1);
                        }
                    }elseif(is_array($params) && is_array($params[0]) && is_array($params[1])){
                        $set = $where = '';
                        foreach($params[0] as $field_s => $value_s){
                            $set .= $field_s.'='.'"'.$value_s.'"'.',';
                        }
                        $set = substr($set,0,-1);
                        foreach($params[1] as $field_w => $value_w){
                            $where .= $field_w.'='.'\''.$value_w.'\''.' and ';
                        }
                        $where = 'where '.substr($where,0,-5);
                    }else{
                        if(ERROR){
                            file::debug('mode:u function:exec -> parameter(third) error','error.dat');
                        }
                        return;
                    }
                    
                    $sql = "update ".PREFIX."{$tbname} set {$set} {$where}";
                } elseif ($iden == 'd'){
                    if(is_string($params)){
                        $where = $params;
                    }elseif(is_array($params)){
                        $where = '';
                        foreach($params as $field=>$value){
                            $where .= $field.'='.'\''.$value.'\''.' and ';
                        }
                        $where = substr($where,0,-5);
                    }else{
                        if(ERROR){
                            file::debug('mode:d function:exec -> parameter(third) error','error.dat');
                        }
                    }
                    $sql = "delete from ".PREFIX."{$tbname} where {$where}";
                } elseif ($iden == 'i'){
                    if(!is_array($params)){
                        if(ERROR){
                            file::debug('mode:i function:exec -> parameter(third) error ','error.dat');
                        }return;
                    }
                    $fields = implode(',',array_keys($params));
                    $values = implode("\",\"",array_values($params));
                    $sql ="insert into ".PREFIX."{$tbname} ({$fields}) values(\"{$values}\")";
                } else{
                    if(ERROR){
                        file::debug('mode:error function:exec','error.dat');
                    }return;
                }
		    }
            if(SQLDEBUG==1){file::debug($sql,'sql_data.dat');}
            ($dbc = $this->connect()) ? $res = $dbc->exec($sql) : $res = false;
            return $res;		
		}
		/**
		* $this->query('username','ident',array('where1'=>1,'where2'=>2),'id desc','0,1');
        * $this->query('username','ident','id>100','id desc','0,1');
        * $this->query('select * from table');
        * $limit(int)
        * where条件如果是字符串需自行加单引号
		**/
		function query($tbname,$ident='',$where='',$order='',$limit=''){
            if(func_num_args()==1){
                $sql = $tbname; 
		    }else{
                empty($ident) ? $ident = '*' : $ident = $ident;
                empty($order) ? $order = ' order by id desc ' : $order = ' order by '.$order;
                empty($limit) ? $limit = '' : $limit = ' limit '.$limit;

                if(is_string($where) && !empty($where)){
                    $there = ' where '.$where.$order;
                }elseif(is_array($where)){
                    foreach($where as $field => $value){
                        $w .= $field.'=\''.$value .'\' and ';
                    }
                    $there = ' where '.substr($w,0,-5).$order;
                }elseif(empty($where)){
                    $there = $where.' '.$order;
                }else{
                    if(ERROR){
                        file::debug('parameter error:where','error.dat');
                    }
                    return;
                }
                $sql = "select {$ident} from ".PREFIX."{$tbname}{$there}{$limit};";
            }
            
            if(SQLDEBUG==1){file::debug($sql,'sql_data.dat');}
            $dbc = $this->connect();
            if($dbc){
                $statement = $dbc->prepare($sql);
                $statement->execute();
                $msg = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return $msg;
		}
		private  function connect(){
            $extension = get_loaded_extensions();
            $exist1 = in_array('PDO',$extension);
            $exist2 = in_array('pdo_mysql',$extension);
            if(!$exist1 || !$exist2){
                if(ERROR){
                    file::debug('the extensions of PDO/pdo_mysql is not found!','notice.dat');
                }
                return;
            }
            $conn = "mysql:dbname=".$this->dbname.";host=".$this->dbhost.";";
			try{
				$this->dbc_msg = new PDO($conn,$this->dbuser,$this->dbpw);
                $this->dbc_msg->exec('set names utf8');
			}catch(PDOException $e){
                if(ERROR){
                    file::debug('error:url'.$e->getFile()."\n".'line: '.$e->getLine()."\n".'describe: '.$e->getMessage()."\n");
                }
            }
            return $this->dbc_msg;
            
		}
        /**
         * $tbname = 表名
         * $where = 条件
         * $ident = 相关字段
         **/
        function get_count($tbname,$where='',$ident='*'){
            $dbc = $this->connect();
            !empty($where) ? $where = 'where '.$where : '';
            $sql = "select count($ident) from ".PREFIX."{$tbname} {$where};";
            if(SQLDEBUG==1){file::debug($sql,'sql_data.dat');}
            $count = $dbc->query($sql);
            if($count){
                foreach($count as $count){$count = $count[0];}
            }else{
                $count = 0;
            }
            
            return intval($count);
        }
	}
?>