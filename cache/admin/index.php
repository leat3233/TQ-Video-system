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
    
    <style>
        .ttitle{
            background-image: linear-gradient( 10deg, #ABDCFF 10%, #0396FF 100%) !important;
            text-shadow: 0 1px 0 #888;
            color: #fff;
            padding: 12px 10px;
            font-size: 14px;border-radius: 4px;
        }
       ul.tags li{
           transition: all 0.3s ease-in-out;width:24%;
           border-radius: 14px;-webkit-box-shadow: 0 1px 3px rgba(33,33,33,.2);
       }
       ul.tags .details .des,ul.tags .details .num{
           font-weight: bold;
       }
       ul.tags li.l1{
           background-image: linear-gradient( 135deg, #ABDCFF 10%, #0396FF 100%) !important;
       } 
       ul.tags li.l2{
           background-image: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%) !important;
       }
       ul.tags li.l3{
           background-image: linear-gradient( 135deg, #FFD3A5 10%, #FD6585 100%) !important;
       }
       ul.tags li.l4{
           background-image: linear-gradient( 135deg, #EE9AE5 10%, #5961F9 100%) !important;
       }
       .row{
           display: flex;
           flex-direction: row;
       }
       .column{
           display: flex;
           flex-direction:column;
       }
       .width-center{
           justify-content: center;
       }
       .height-center{
           align-items: center;
       }
       .between{
           justify-content: space-between;
       }
       .around{
           justify-content: space-around;
       }
       .avatar{
           width:40px;height: 40px;border-radius: 50%;object-fit: cover;margin-right: 10px;
       }
       table{
           border-top: 1px solid #ddd;
       }
       td{
           text-align: center;font-size:14px;padding:10px 0;border-right: 1px solid #fff;
       }
       .flex-center{
           justify-content: center;align-items: center;
       }
       table tr:nth-child(even){
           background-color: rgba(0, 0, 0, 0.03);
       }
       .mt30{
           margin-top:30px;
       }
       .stitle{
             margin-bottom: 10px;
            font-family: 'Roboto', Arial, Helvetica, sans-serif;
            font-size: 18px;
            padding-left: 20px;
            padding-top: 15px;
            line-height: 30px;
            color: #676767;
            font-weight: 400;
            display: inline-block;
       }
       .nickname{
           color:#505458;
       }
       .dtinme{
           color: #999999;font-size:12px;
       }
       .color{
            position: absolute;top:0;left:-40px;
            width: 20px;
            height: 20px;
            border-radius: 5px;
            transform: translateY(-50%);
       }
       .color1{
           background-image: linear-gradient(-12deg,#2a57d7 0,#9eeeff 100%) !important;
       }
       .color2{
               background-image: linear-gradient(-12deg,#F88691 0, #FCD3BB 100%) !important;
       }
       .color3{
           background-image: linear-gradient(126deg,#7bead0 0,#4BC39D 100%) !important;
       }
       .color4{
           background-image: linear-gradient(126deg,#b960e0 0,#a890f5 100%) !important;
       }
       .color5{
           background-image: linear-gradient(to right bottom, #e8962e, #e45131) !important;
       }
       .wrap-width{
           width:49%;
       }
       .wrap-width .frmtable{
           height:600px;
       }
       .frmtable3{
           width: 90%;
            padding: 23px 5%;
            height: 145px;
            box-shadow: 0 1px 5px 0px #ccc;
            background: #fff;   
       }
       .wrap-width .frmtable2{
            width: 40%;
            padding: 23px;
            height: 145px;
            box-shadow: 0 1px 5px 0px #ccc;
       }
       .p1{
           color: #969696;font-size:14px;
       }
        .p2{
           color: #505458;;font-size:30px;font-weight: bold;margin:15px 0;
       }
        .p3{
           color: rgba(118, 118, 118, 1.0);font-size:14px;
       }
        .p4{
            color: #19d895;font-size:14px;
       }
       .p5{
            color: red;font-size:14px;
       }
       .line{
           width: 100%;height:1px;background: #eee;margin-top:20px;
       }
       .badge-success{
            background-color: #19d895;
            font-size: 18px;
            color: #ffffff;
            border-radius: 7px;
            padding: 3px 3px;
            margin-left: 10px;
       }
       .badge-danger{
           background-color: red;
            font-size: 18px;
            color: #ffffff;
            border-radius: 7px;
            padding: 3px 3px;
            margin-left: 10px;
       }
       .charts {
          width: 100%;margin-top:30px;
          height: 360px;
        }
        .l1{
            font-size: 15px;
            font-weight: 700;
        }
        .l2{
            font-size: 12px;
            color: #505458;margin-top:7px;
        }
        .l3{
            color: #ab8ce4 !important;
            font-size:23px;
            font-weight: bold;
        }
        .l4{
            font-size: 14px;
            color: #777;margin-top:7px;
        }
        .l5{
            font-size: 14px;
            color: #777;margin-top:7px;
        }
        .l6{
            font-size: 14px;
            color: #777;margin-top:7px;
        }
        .l7{
            font-size: 14px;
            color: #777;margin-top:7px;
        }
        .l8{
            font-size: 14px;
            color: #777;margin-top:7px;
        }
        .sys{
           border-bottom:1px solid #eee; 
        }
        .sys tr td{
            text-align: left;border-top:1px solid #eee;
            border-left:1px solid #eee;border-right:1px solid #eee;
            padding:10px;
        }
        .sys tr td:nth-child(odd){
           font-weight: bold;
        }
        .aa tr td{
            padding:10px 0 !important;padding: 10px 0 !important;
    height: 12px;
    max-width: 180px;
        }
        .pay1{
            background: #24d2b5 !important;color:#fff;font-size:14px;    width: 75%;
    margin: 0 auto;
    border-radius: 100px;
    padding: 5px 0;
        }
        .pay2{
               background: #ff5c6c !important;color:#fff;font-size:14px;    width: 75%;
    margin: 0 auto;
    border-radius: 100px;
    padding: 5px 0;
        }
        .l8{
            color: #FD7D8C;
            margin-top: 12px;
            font-weight: bold;
            font-size: 20px;
        }
        .l9{
            color: #FD7D8C;
            font-size:23px;
            font-weight: bold;
        }
        .pad{
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
        .aaa{
            margin-top:15px;
        }
        .aaa a{
           background: #FD7D8C;
            color: #fff;
            font-size: 14px;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 7px;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <?php file::import("system-model-admin-header"); ?>
    <?php file::import("system-model-admin-aside"); ?>
    <div class="wrap">
        <div class="w100">
            <!--<div class="frame">-->
            <!--        <p class="title">失效域名报告</p>-->
            <!--        <div class="frmtable">-->
            <!--            <?php echo $this->vars["urllist"] ?>-->
            <!--        </div>-->
                    
            <!--    </div>-->
            <div class="content" style="margin-top:0">
                <div class="row between">
                    <div class="frame  w100">
                       <div class="frmtable column">
                           <p class="ttitle">服务器信息:</p>
                           <table class="sys">
                               <tr>
                                   <td>系统信息</td>
                                   <td colspan="3"><?php echo $this->vars["a1"] ?></td>
                               </tr>
                               <tr>
                                   <td>PHP软件版</td>
                                   <td><?php echo $this->vars["a2"] ?></td>
                                   
                                   <td>最大执行时间</td>
                                   <td><?php echo $this->vars["a8"] ?></td>
                               </tr>
                               <tr>
                                   <td>脚本运行占用最大内存</td>
                                   <td><?php echo $this->vars["a3"] ?></td>
                                   
                                   <td>Zend版本</td>
                                   <td><?php echo $this->vars["a9"] ?></td>
                               </tr>
                               <tr>
                                   <td>最大上传文件大小</td>
                                   <td><?php echo $this->vars["a4"] ?></td>
                                   
                                   <td>服务器语言</td>
                                   <td><?php echo $this->vars["a10"] ?></td>
                               </tr>
                               <tr>
                                   <td>PHP运行方式</td>
                                   <td><?php echo $this->vars["a5"] ?></td>
                                   
                                   <td>服务器Web端口</td>
                                   <td><?php echo $this->vars["a11"] ?></td>
                               </tr>
                               <tr>
                                   <td>通信协议</td>
                                   <td><?php echo $this->vars["a6"] ?></td>
                                   
                                   <td>服务器操作系统</td>
                                   <td><?php echo $this->vars["a12"] ?></td>
                               </tr>
                               <tr>
                                   <td>服务器解译引擎</td>
                                   <td><?php echo $this->vars["a7"] ?></td>
                                   
                                   <td>服务器系统时间</td>
                                   <td><?php echo $this->vars["a13"] ?></td>
                               </tr>
                           </table>
                        </div>
                    </div>
                </div>
                <div class="frame mt30">
                    <div class="frmtable column">
			            <ul class="tags">
                            <li class="m l1">
                                <i class="fa fa-comments-o f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["num1"] ?> </div>
                                    <div class="des"> 今日登录人数 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                            <li class="m l2">
                                <i class="fa fa-bar-chart f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["num2"] ?> </div>
                                    <div class="des"> 昨日新增用户量 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                            <li class="m l3">
                                <i class="fa fa-pagelines f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["num3"] ?> </div>
                                    <div class="des"> 总用户量 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                            <li class="l4">
                                <i class="fa fa-gitlab f"></i>
                                <div class="details abs">
                                    <div class="num" style="font-size:21px"> 查看 </div>
                                    <div class="des"> 用户列表  </div>
                                </div>
                                <p class="abs w100"><a href='<?php echo INDEX ?>/admin.php?mod=userlist' class=' block'>查看更多<i class='fa fa-arrow-circle-right'></i></a></p>
                            </li>
                        </ul>
                        <ul class="tags">
                            <li class="m l1">
                                <i class="fa fa-comments-o f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["b1"] ?> </div>
                                    <div class="des"> 今日签到人数 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                            <li class="m l2">
                                <i class="fa fa-bar-chart f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["b2"] ?> </div>
                                    <div class="des"> 充值总额 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                            <li class="m l3">
                                <i class="fa fa-pagelines f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["b3"] ?> </div>
                                    <div class="des"> VIP用户量 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                            <li class="l4">
                                <i class="fa fa-pagelines f"></i>
                                <div class="details abs">
                                    <div class="num"> <?php echo $this->vars["b4"] ?> </div>
                                    <div class="des"> 总评论数 </div>
                                </div>
                                <p class="abs w100"></p>
                            </li>
                        </ul>
                    </div>
                </div>
               
                
                <div class="row between">
                    <div class="column mt30 wrap-width">
                        <div class="row between">
                             <div class="column frame frmtable2 around">
                              <div class="column">
                                  <p class="l1">快捷链接</p>
                                  <div class="row height-center aaa" style="flex-wrap:wrap">
                                      <a href="<?php echo INDEX ?>/admin.php?mod=set">系统设置</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=recharge">充值管理</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=topiclist">话题</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=userlist">用户管理</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=addadv">广告</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=commentslist">评论管理</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=videolist">长视频管理</a>
                                      <a href="<?php echo INDEX ?>/admin.php?mod=shortvideomanager">短视频管理</a>
                                  </div>
                              </div>

                            </div>
                            <div class="column frame frmtable2 around">
                              <div class="row between height-center">
                                  <div class="column">
                                      <p class="l1">长视频总数</p>
                                      <p class="l2">Total number of long videos</p>
                                  </div>
                                  <div class="column height-center">
                                      <p class="l9"><?php echo $this->vars["chang"] ?></p>
                                     
                                  </div>
                              </div>
                              <div class="row between height-center pad">
                                  <div class="column">
                                      <p class="l1">短视频总数</p>
                                      <p class="l2">Total number of short videos</p>
                                  </div>
                                  <div class="column height-center">
                                      <p class="l9"><?php echo $this->vars["duan"] ?></p>
                                     
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="column mt30 wrap-width">
                        <div class="row between">
                            <div class="column frame frmtable2 around">
                              <div class="row between height-center">
                                  <div class="column">
                                      <p class="l1">官方消息总数</p>
                                      <p class="l2">Total official messages</p>
                                  </div>
                                  <div class="column height-center">
                                      <p class="l9"><?php echo $this->vars["xiaoxi"] ?></p>
                                     
                                  </div>
                              </div>
                              <div class="row between height-center pad">
                                  <div class="column">
                                      <p class="l1">官方活动总数</p>
                                      <p class="l2">Total official activities</p>
                                  </div>
                                  <div class="column height-center">
                                      <p class="l9"><?php echo $this->vars["huodong"] ?></p>
                                     
                                  </div>
                              </div>
                            </div>
                            <div class="column frame frmtable2 around">
                              <div class="row between height-center">
                                  <div class="column">
                                      <p class="l1">广告总数</p>
                                      <p class="l2">Total number of advertisements</p>
                                  </div>
                                  <div class="column height-center">
                                      <p class="l9"><?php echo $this->vars["guanggao"] ?></p>
                                     
                                  </div>
                              </div>
                              <div class="row between height-center pad">
                                  <div class="column">
                                      <p class="l1">话题总数</p>
                                      <p class="l2">Total number of topics</p>
                                  </div>
                                  <div class="column height-center">
                                      <p class="l9"><?php echo $this->vars["huati"] ?></p>
                                     
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row between">
                    <div class="frame mt30 wrap-width">
                   <div class="frmtable column">
                       <div class="ttitle">最新评论</div>
                       <table class="w100 aa">
                                <tr>
                                    <th>用户名</th>
                                    <th>评论</th>
                                    <th>评论时间</th>
                                    <th>操作</th>
                                </tr>
                                <?php echo $this->vars["data2"] ?>
                            </table>
                    </div>
                </div>
                <div class="frame mt30 wrap-width">
                   <div class="frmtable column">
                       <div class="ttitle">最新支付用户</div>
                       <table class="w100 aa">
                                <tr>
                                    <th>用户名</th>
                                    <th>充值金额</th>
                                    <th>支付类型</th>
                                    <th>订单号</th>
                                    <th>支付状态</th>
                                </tr>
                                <?php echo $this->vars["data3"] ?>
                            </table>
                    </div>
                </div>
                </div>
                <div class="frame mt30">
                   <div class="frmtable column">
                            <div class="ttitle">最新注册用户</div>
                            <table class="w100">
                                <tr>
                                    <th>用户名</th>
                                    <th>用户ID</th>
                                    <th>用户IP</th>
                                    <th>用户地址</th>
                                    <th>手机型号</th>
                                </tr>
                                <?php echo $this->vars["data"] ?>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo JS ?>/u-charts.js"></script>
    <script language="JavaScript">
var uChartsInstance = '';

function showCharts(id,data){
  const canvas = document.getElementById(id);
  const ctx = canvas.getContext("2d");
  canvas.width = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;
  uChartsInstance[id] = new uCharts({
    animation: true,
    background: "#FFFFFF",
    categories: data.categories,
    color: ["#1890FF","#91CB74","#FAC858","#EE6666","#73C0DE","#3CA272","#FC8452","#9A60B4","#ea7ccc"],
    context: ctx,
    extra: {
      column: {
        type: "group",
        width: 30,
        activeBgColor: "#000000",
        activeBgOpacity: 0.08
      }
    },
    height: canvas.height,
    legend: '',
    padding: [15,15,0,5],
    series: data.series,
    type: "column",
    width: canvas.width,
    xAxis: {
      disableGrid: true
    },
    yAxis: {
      data: [
        {
          min: 0
        }
      ]
    }
  });
  canvas.onclick = function(e) {
    uChartsInstance[id].touchLegend(getH5Offset(e));
    uChartsInstance[id].showToolTip(getH5Offset(e));
  };
  canvas.onmousemove=function(e) {
    uChartsInstance[id].showToolTip(getH5Offset(e));
  };
}

function getServerData() {
  //模拟从服务器获取数据时的延时
  setTimeout(() => {
    //模拟服务器返回数据，如果数据格式和标准格式不同，需自行按下面的格式拼接
    let res = {
      categories: ["<?php echo $this->vars["day5"] ?>","<?php echo $this->vars["day4"] ?>","<?php echo $this->vars["day3"] ?>","<?php echo $this->vars["day2"] ?>","<?php echo $this->vars["day1"] ?>","今日"],
      series: [
        {
          name: "新增会员",
          data: ['<?php echo $this->vars["adduser5"] ?>','<?php echo $this->vars["adduser4"] ?>','<?php echo $this->vars["adduser3"] ?>','<?php echo $this->vars["adduser2"] ?>','<?php echo $this->vars["adduser1"] ?>','<?php echo $this->vars["adduser0"] ?>']
        },
        {
          name: "会员充值量",
          data: ['<?php echo $this->vars["addpay5"] ?>','<?php echo $this->vars["addpay4"] ?>','<?php echo $this->vars["addpay3"] ?>','<?php echo $this->vars["addpay2"] ?>','<?php echo $this->vars["addpay1"] ?>','<?php echo $this->vars["addpay0"] ?>']
        }
      ]
    };
    showCharts('jBnaXCJZgfBAfOnZQTMZKXtmHoNjOsaD', res);
  }, 500);
}

getServerData();
</script>
<script>
    $(function(){
         $('.del').click(function(){
    	if(confirm('请再次确认是否真的删除?')){
    		ajax('delete',"id="+$(this).attr('id')+"&table="+$(this).attr('rel'));
    	}
    }); 
    });
</script>
</body>
</html>