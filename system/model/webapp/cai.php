
 <?php 
    set_time_limit(0);
    ignore_user_abort(true);


    $db= functions::db();
   
    $_url = CW('post/caiurl');
    if(!$_url){
      msg('链接为必填项','确定','','',false);
    }

    //$db->query("TRUNCATE topic");
    //$db->query("TRUNCATE post");
   
    $temp = json_decode(get_contents($_url));

    $pp1 = $temp->pagecount;    
   
    for($i=1;$i<=$pp1;$i++){
        $url = $_url.'&pg='.$i;
        $datas = json_decode(get_contents($url))->list;
     
      
        foreach ($datas as $data){
            $topic = $data->type_name;     
            
            
            $id = $db->query('topic','id',"name='{$topic}'",'',1);
            $id = $id[0]['id'];
            if(!$id){
                $db->exec('topic','i',array(
                    'name'=>$topic,
                    'cover'=>'../../static/img/this.png',
                    'desces'=>'该分类暂无描述~',
                    'hot'=>mt_rand(1000,5000)
                ));
                $id = $db->query('topic','id',"name='{$topic}'",'',1);
                $id = $id[0]['id'];
            }
            $title = $data->vod_name;
            $texist = $db->query("select id from post where title='{$title}' limit 1");
            if($texist[0]['id']){
                continue;
            }

            $_url2 = substr($_url,0,stripos($_url,':')).'://'.parse_url($_url)['host'];
     
            $detail = $_url2.'/api.php/provide/vod/?ac=detail&ids='.$data->vod_id;
            $detail = json_decode(get_contents($detail))->list[0];
           

            
            $videocover = $detail->vod_pic;
            $videourl = $detail->vod_play_url;
            $videourl = substr($videourl,strripos($videourl,'https'));

            $tags = $detail->vod_tag;
             $diamond = mt_rand(10,30);
             //$vipdiam = mt_rand(10,30);
             $vipdiam=0;
             if($vipdiam>$diamond){
                 $vipdiam = mt_rand(5,9);
             }
             $is0 = mt_rand(1,10);
             if($is0<=2){
                 $diamond = 0;
                 $vipdiam = 0;
             }
            $flag = array('VIP推荐','推荐','精品优选','大V推荐','热搜','推荐','置顶','会员精选','VIP Heaven7','VIP热播','精选钻石');
            $allnum = mt_rand(2,4);
            $keys = array_rand($flag,$allnum);
            $res = '';
            if($allnum==2){
                $res = $flag[$keys[0]].'|'.$flag[$keys[1]];
            }else if($allnum==3){
                $res = $flag[$keys[0]].'|'.$flag[$keys[1]].'|'.$flag[$keys[2]];
            }else{
                $res = $flag[$keys[0]].'|'.$flag[$keys[1]].'|'.$flag[$keys[2]].'|'.$flag[$keys[3]];
            }
     
            $db->exec('post','i',array(
                    'title'=>$title,
                    'userid'=>'18888888888',
                    'videocover'=>$videocover,
                    'videourl'=>$videourl,
                    'imglist'=>'',
                    'diamond'=>$diamond ? $diamond : 0,
                    'vipdiam'=>$vipdiam ? $vipdiam : 0,
                    'hot'=>mt_rand(50,99999),
                    'ptime'=>mt_rand(0,9).mt_rand(0,5).':'.mt_rand(0,5).mt_rand(0,5),
                    'pnum'=>mt_rand(50,99999),
                    'likes'=>mt_rand(50,200),
                    'flag'=>$res,
                    'topic'=>$id,
                    'ftime'=>time(),
                    'ishow'=>1,
                    'tags'=>$tags,
                    //'biaoqian'=>$tags
                ));
        }
    }
  
     function get_contents($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            //var_dump(curl_error($ch));
            curl_close($ch);
            return $data;
        }
         function put_contents($file,$content){
            $fp = fopen($file, 'w');
			fwrite($fp,$content);
			fclose($fp);
        }

        
?>
