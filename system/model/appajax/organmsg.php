
<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $topics = $db->query('topic','','','hot desc',4);
    $topic_array = array();
    foreach($topics as $topic){
      $hot = functions::hot($topic['hot']);
      $num = $db->get_count('post',"ishow=1 and instr(topic,'{$topic['id']}')");
      array_push($topic_array,array(
          'id'=>$topic['id'],
          'name'=>$topic['name'],
          'desc'=>"含内容{$num}篇",
          'hot'=>$hot,
          'cover'=>$topic['cover']
      ));
    }
    //输出
    echo json_encode(array(
        'topic_array'=>$topic_array,
        
    ));
?>


