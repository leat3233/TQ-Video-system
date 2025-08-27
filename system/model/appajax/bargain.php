<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $data = array();
    $recommends = $db->query('recommend','','id=1');
    for($i=1;$i<=7;$i++){
        
        $pre = $recommends[0]["pak{$i}"];
        
        $vids = substr($pre,strpos($pre,'/')+1);
        $vids = substr($vids,0,strripos($vids,'/'));
        
        $diam = substr($pre,strripos($pre,'/')+1);
        $where = "id in ($vids)";
        array_push($data,array(
            'title'=>substr($pre,0,strpos($pre,'/')),
            'array'=>get_data($db->query('post','videourl,vipdiam,diamond,id,videocover,title,userid',$where,'id desc',10)),
            'pay'=>$diam.'金币购买'.count(explode(',',$vids)).'部',
            'paymsg'=>"$diam/$vids"
        ));
    }
    // if($type==1){
    //     $pak1 = $recommend[0]['pak1'];
    //     $pak1_title = substr($pak1,0,strpos($pak1,'/'));
    //     $pak1_diam = substr($pak1,strripos($pak1,'/')+1);
    //     $pak1_vids = substr($pak1,strpos($pak1,'/')+1);
    //     $pak1_vids = $pak1_listid = substr($pak1_vids,0,strripos($pak1_vids,'/'));
    //     $pak1_vids = explode(',',$pak1_vids);
    //     $pak1_text = $pak1_diam.'钻石购买'.count($pak1_vids).'部';
    //     $pak1_vids = UI($pak1_vids,1,$db);
        
    //     $data = "<div class='title rel '>
    //               <p class='line'></p>
    //               <p class='abs t1 pak1_title'>{$pak1_title}</p>
    //             </div>
    //             <ul class='part1'>
    //              {$pak1_vids}
    //             </ul>
    //             <p class='buy pak1_buy' tapmode onclick=\"pak_buy($pak1_diam,'$pak1_listid')\"><span class='pak1_text'>{$pak1_text}</span><img class='fr' src='../../image/home_tag_buy_right.png' /><img class='abs' src='../../image/album_buy_text.png' /></p>";
    //     if($pak1_vids){
    //         echo json_encode(array(
    //             'state'=>1,
    //           'data'=>$data 
    //         ));
    //     }
    // }
    

    // function UI($datas,$type=1,$db){
    //     $data = '';
    //     if($type==1){
    //         foreach($datas as $val){
    //           $post = $db->query('post','',"id='{$val}'",'',1);
    //           $tips = functions::gettips($post[0]['vipdiam'],$post[0]['diamond']);
    //           $hot = functions::hot($post[0]['hot']);
    //           $topic = functions::gettopic(explode(',',$post[0]['topic']),1);
            
    //           $data .="<li tapmode  onclick=\"openvideo({$post[0]['id']},'{$post[0]['title']}','{$post[0]['videocover']}','{$post[0]['videourl']}')\">
    //             <p class='img'>
    //               {$tips}
    //               <img src='{$post[0]['videocover']}'>
    //             </p>
    //             <p class='word'>{$post[0]['title']}</p>
    //             <div class='bt'>
    //                 <div class='fl hideline'>
    //                     {$topic}
    //                 </div>
    //                 <div class='fr'>
    //                     <img src='../../image/icon_discount_select.png'>
    //                     {$hot}
    //                 </div>
    //                 <div class='clear'></div>
    //             </div>
    //         </li>";
    //         }
            
    //     }
    //     return $data;
    // }
    
    
    echo json_encode(array(
        'data'=>$data
    ));
    function get_data($datas){
        $array = array();
        $db = functions::db();
        foreach($datas as $data){
          $tips = functions::gettips($data['vipdiam'],$data['diamond']);
          $user =  $db->query('users','nickname,avatar,tel',"tel='{$data['userid']}'",'',1);
          array_push($array,array(
                  'id'=>$data['id'],
                  'tit'=>$data['title'],
                  'src'=>$data['videocover'],
                  'tag'=>$tips,
                  'pnum'=>$data['pnum'],
                  'ptime'=>$data['ptime'],
                  'diam'=>$data['diamond'],
                  'avatar'=>str_replace('image','static',$user[0]['avatar']),
                  'nickname'=>$user[0]['nickname'],
                  'uid'=>$user[0]['tel'],
              ));
        }
        return $array;
    }
?>


