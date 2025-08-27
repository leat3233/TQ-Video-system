
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $type = CW('gp/type');
    if($type=='my'){
        $tel = CW('gp/tel');
        $where = "ishow=1 and videocover!='' and userid='{$tel}'";
    }else{
        $where = "ishow=1 and videocover!='' ";
    }
    
    $page = CW('gp/page') ? CW('gp/page') : 0;
    $pagestart = $page*APPSIZE;
    $more = get_data($db->query('post','videourl,vipdiam,diamond,id,videocover,title,userid',$where,'id desc',"{$pagestart},".APPSIZE));
    //输出
    if(!$more){
        echo json_encode(array(
            'more'=>'over',
        ));return;
    }
    echo json_encode(array(
        'more'=>$more,
        'page'=>intval($page)+1
    ));
    
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
            
          if($data['imglist']!=''){
              
               $imglist =explode('|',$data['imglist']);
              $cover = $imglist[0];
              $type = '微社区';
          }elseif($data['shortvidcover']!=''){
              $cover = $data['shortvidcover'];
              $type = '短视频';
              
          }elseif($data['videocover']!=''){
             $cover = $data['videocover'];
              $type = '长视频';
             
          } 
            
            
            
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          array_push($array,array(
              'type'=>$type,
                  'id'=>$data['id'],
                  'tit'=>$data['title'],
                  'src'=>$data['videocover'],
                  'tag'=>$tips,
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
                  'u'=>$user[0]['tel']
              ));
        }
        return $array;
    }
?>


