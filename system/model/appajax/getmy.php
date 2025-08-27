
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $postidlists = $db->query('likes','postid',"tel='{$tel}'");
    foreach($postidlists as $postidlist){
        $postid_list .= $postidlist['postid'].',';
    }
    $postid_list = rtrim($postid_list,',');
    $where = "ishow=1  and id in($postid_list)";
    $data = get_data($db->query('post','',$where,'id desc',APPSIZE));
    $user = $db->query('users','',"tel='{$tel}'",'',1);
    $mylevel = $user[0]['mylevel'];
    if($mylevel==1){
        $vipname = "青铜会员";
    }else if($mylevel==2){
        $vipname = "钻石会员";
    }else if($mylevel==3){
      $vipname = "铂金会员";
    }else if($mylevel==4){
      $vipname = "至尊会员";
    }else if($mylevel==5){
      $vipname = "官方会员";
    }else if($mylevel==6){
      $vipname = "大V会员";
    }else if($mylevel==7){
      $vipname = "商家会员";
    }else{
      $vipname = "普通会员";
    }
    $sets = $db->query('sets','adda,addb,changnum,duannum','id=1');
    $a = $sets[0]['changnum']-$user[0]['changnum'];
    $b = $sets[0]['duannum']-$user[0]['duannum'];
    ////add
    $utime = date('Y/m/d',$user[0]['looktime']);
    $ctime = date('Y/m/d',time());
    if($utime!=$ctime){
        $a = $sets[0]['changnum'];
        $b = $sets[0]['duannum'];
    }
    $a = $a<0 ? 0 : $a.'/每日';
    $b = $b<0 ? 0 : $b.'/每日';
    if($user[0]['viptime']>time()){
        $a = $b = "无限";
    }
    echo json_encode(array(
        'data'=>$data,
        'nickname'=>$user[0]['nickname'],
        'level'=>$mylevel,
        'avatar'=>str_replace('image','static',$user[0]['avatar']),
        'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman',
        'money'=>$user[0]['money'],
        'diam'=>functions::hot($user[0]['diam']),
        'vipname'=>$vipname,
        'adda'=>$sets[0]['adda'],
        'addb'=>$sets[0]['addb'],
        'changnum'=>$a,
        'duannum'=>$b,
    ));
    
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          $type = '';
          $cover = '';
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
          array_push($array,array(
                  'type'=>$type,
                  'id'=>$data['id'],
                  'tit'=>$data['title'],
                  'src'=>$cover,
                  'ptime'=>$data['ptime'],
                  'hot'=>functions::hot($data['hot']),
                  'pnum'=>functions::hot($data['pnum']),
                  'tag'=>$tips,
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
              ));
        }
        return $array;
    }
?>


