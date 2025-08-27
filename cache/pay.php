<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, initial-scale=1.0, width=device-width" />
    <meta name="format-detection" content="telephone=no, email=no, date=no, address=no">
    <title>支付</title>
    <script src="<?php echo JS ?>/jquery-1.8.3.min.js"></script>
    <style>
        html,body{
            width: 100%;height:100%;margin:0; padding:0;font-family:'微软雅黑';color:#666;
            background: #7265E4;
            color:#fff;
        }
        ul,li{
            list-style: none;
            margin-bottom: 10px;
        }
        li p{
            display: inline;
        }
        header{
            height:55px;
            border-bottom:1px solid #efefef;
            color:#fff;
            line-height: 55px;text-align: center;
            font-size:17px;background: #000;
        }
        .wrap{
            margin:15px;
        }
        p.title{
            font-size:20px;font-weight: bold;
            border-bottom: 1px dashed #fff;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        p.money{
            font-size: 18px;
            padding: 10px 0;
            font-weight: bold;
            color:#9dff00;
        }
        footer{
            position: fixed;
            width:100%;
            height:56px;
            bottom:0;left:0;
            z-index: 1;
            background: #000;
        }
        footer .p{
            height: 40px;
            background: red;
            width: 100px;
            line-height: 40px;
            text-align: center;
            border-radius: 7px;
            top: 8px;
            right: 20px;
            position: absolute;
            font-weight: bold;
            color:#fff;
            border:0;
            font-size:14px;
        }
        select{
            width: 50%;
            height: 30px;
            border-radius: 7px;
        }
        input{
                background: red;
    border: 0;
    padding: 5px 100px;
    color: #fff;
    border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <?php echo $this->vars["cardname"] ?>
    </header>
    <form action="<?php echo INDEX ?>/pay/index.php" method="post">
    <div class="wrap">
        <p>支付金额: <?php echo $this->vars["price"] ?>元</p>
        <p>订单号: <?php echo $this->vars["payMchOrderNo"] ?></p>
        <p>支付时间: <?php echo $this->vars["time"] ?></p>
        <p>支付类型: <select name="type">
            <option value="alipay">支付宝</option>
            <option value="wxpay">微信支付</option>
        </select></p>
    </div>
    <footer style="text-align:center">
            <input type="hidden" name="userorder" value="<?php echo $this->vars["payMchOrderNo"] ?>"  />
            <input type="hidden" name="price" value="<?php echo $this->vars["price"] ?>"  />
            <input type="hidden" name="param" value="<?php echo $this->vars["param1"] ?>|<?php echo $this->vars["param2"] ?>"  />
         
            <p><input type="submit" value="立即支付"></p>
           
    </footer>
    </form>
   
</body>
</html>
               