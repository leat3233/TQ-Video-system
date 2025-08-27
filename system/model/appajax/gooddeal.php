
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $data = array();
    $gooddeals = $db->query('gooddeal','','','id desc');
    foreach ($gooddeals as $val){
   
      $vidlist = $val['vidlist'];
      $hot = functions::hot($val['hot']);
    //   $jnum++;
    //   if($jnum<=3){
    //       $rankimg = "<img src='../../image/rank{$jnum}.png' />";
    //   }else{
    //       $rankimg = '';
    //   }
        array_push($data,array(
            'vidlist'=>$vidlist,
            'btit'=>$val['btit'],
            'desc'=>$val['descs'],
            'cover'=>$val['cover'],
            'num'=>count(explode(',',$vidlist)),
            'stit'=>$val['stit'],
            'diam'=>$val['diamond'],
            'star1'=>intval($val['star1']),
            'star2'=>intval($val['star2']),
            'star3'=>intval($val['star3']),
            'hot'=>$hot,
            'id'=>$val['id']
        ));
    }
   
    
    //输出
    echo json_encode(array(
        'data'=>$data
    ));

    function star($num){
        $ret = '';
        if($num=='4'){
            $ret = "<img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x3.png' />";
        }elseif ($num==='4.5') {
            $ret = "<img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x2.png' />";
        }elseif ($num=='5'){
            $ret = "<img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' /><img src='../../static/x1.png' />";
        }
        return $ret;
    }
?>


