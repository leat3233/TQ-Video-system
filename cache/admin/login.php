<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo TITLE ?></title>
    <link rel="stylesheet" href="<?php echo CSS ?>/backstage.css" />
    <link rel="stylesheet" href="<?php echo CSS ?>/font-awesome.min.css" />
    <script src="<?php echo JS ?>/jquery-1.8.3.min.js"></script>
    <script src="<?php echo JS ?>/backstage.js"></script>
</head>
<body>
    <div class="loginbody w100 h100">
        <div class="login rel">
            <p class="abs">SIGN IN</p>
            <div class="w">
                <img class="l" src="<?php echo IMG ?>/loginlogo.png" />
                <div>
                    <input name="username" placeholder="User ID" />
                    <input name="password" placeholder="Password" />
                    <input name="password2" placeholder="SPassword" />
                    <!--<input name="code" placeholder="Dynamic code" style="width: 40%;" /><img class="fr iblock code" src="<?php echo INDEX ?>/index.php?mod=code" onclick="this.src=this.src+'?'+Math.random()" />-->
                    <a class="tologin" href="javascript:;"><i class="fa fa-check"></i></a>
                </div>
            </div>
            <a class="abs" target="_blank" href="https://browser.qq.com/">推荐使用QQ浏览器</a>
            <div class="abs" >©版权所有 2024-2099 | 后台管理系统</div>
        </div>
    </div>
</body>
</html>