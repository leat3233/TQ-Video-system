<?php
    $url = $_GET['url'];
    if(CW('gp/encoded')){
        $url = functions::autocode($url);
    }
    echo functions::qrcode($url)
?>