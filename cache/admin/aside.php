<script>
   
   
</script>
<div class="fix aside">
    <ul>
        <li>
            <a href="<?php echo INDEX ?>/index.gsp">
                <i class="fa fa-home"></i>
                <span>首页</span>
            </a>

        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-slack"></i>
                <span>话题模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=topiclist">话题管理</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa  fa-video-camera"></i>
                <span>视频模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=videolist">视频列表管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=video">视频添加</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-users"></i>
                <span>微社区模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=organlist">微社区管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=organ">微社区添加</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-comments"></i>
                <span>评论模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=commentslist">评论管理</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-commenting-o"></i>
                <span>消息/活动模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=noticelist">平台通知/官方消息</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=messagelist">用户消息管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=activitylist">官方活动管理</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-address-card"></i>
                <span>用户模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=userlist">用户管理</a></p>
            </div>
        </li>
        
        <!--<li>-->
        <!--    <a href="javascript:void(0)">-->
        <!--        <i class="fa fa-address-card"></i>-->
        <!--        <span>销售模块</span>-->
        <!--        <i class="fa fa-plus fr"></i>-->
        <!--    </a>-->
        <!--    <div class="hide">-->
        <!--    	<p><a href="<?php echo INDEX ?>/admin.php?mod=sellviplist">会员销售详情</a></p>-->
        <!--    	<p><a href="<?php echo INDEX ?>/admin.php?mod=selldiamlist">钻石销售详情</a></p>-->
        <!--    	<p><a href="<?php echo INDEX ?>/admin.php?mod=sellvideolist">影片销售详情</a></p>-->
        <!--    </div>-->
        <!--</li>-->
        
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-sign-in"></i>
                <span>充值模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=recharge">充值管理</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-calendar"></i>
                <span>签到模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=signinlist">签到管理</a></p>
            </div>
        </li>
        
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-share-alt"></i>
                <span>邀请模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=invitelist">邀请管理</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-globe"></i>
                <span>广告模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=addadv">广告添加</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=advapp">应用广告管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=advvidlist">APP视频/应用中心/VIP广告管理</a></p>
            	
            </div>
        </li>
        
        <li>
            <a href="javascript:void(0)" >
                <i class="fa fa-cog"></i>
                <span>系统模块</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=updatepass">后台密码修改</a></p>
                
                <!--<p><a href="<?php echo INDEX ?>/admin.php?mod=message">短信配置</a></p>-->
                <!--<p><a href="<?php echo INDEX ?>/admin.php?mod=pay">支付配置</a></p>-->
                <!--<p><a href="<?php echo INDEX ?>/admin.php?mod=senven">七牛配置</a></p>-->
            </div>
        </li>
       
        <div class="clear"></div>
    </ul>
    <p class="appset">代理设置</p>
    <ul>
        <li>
            <a href="<?php echo INDEX ?>/admin.php?mod=dlopen">
                <i class="fa fa-address-book-o"></i>
                <span>代理开线</span>
            </a>
        </li>
        <li>
            <a href="<?php echo INDEX ?>/admin.php?mod=dllist">
                <i class="fa fa-address-book-o"></i>
                <span>代理商列表</span>
            </a>
        </li>
        <li>
            <a href="<?php echo INDEX ?>/admin.php?mod=dluser">
                <i class="fa fa-address-book-o"></i>
                <span>代理用户列表</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-address-book-o"></i>
                <span>代理-收益管理</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=earningslist">收益管理</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-address-book-o"></i>
                <span>代理-提现管理</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=withdrawals">提现管理</a></p>
            </div>
        </li>
      
    </ul>
    <p class="appset">APP内部设置</p>
    <ul>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-home fa-fw"></i>
                <span>首页</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                
                <p><a href="<?php echo INDEX ?>/admin.php?mod=announcement">公告设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=indexrecommend">推荐-爆款/聚划算设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=seckilllist">推荐-整点秒杀管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=seckill">推荐-整点添加</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=selected">精选添加</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=selectedlist">精选管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=hotsearch">热搜榜关键词设置</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-heart"></i>
                <span>糖圈</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=wechatcomments">推荐设置</a></p>
            </div>
        </li>
      
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-dashboard"></i>
                <span>VIP</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=promotionallist">聚划算管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=promotional">聚划算添加</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-video-camera"></i>
                <span>短视频</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=shortvideomanager">短视频管理</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=shortvideo">短视频添加</a></p>
              
                
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-send-o"></i>
                <span>消息</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=notice">发布平台通知/官方消息</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=activity">发布官方活动</a></p>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i class="fa fa-user-circle"></i>
                <span>我的</span>
                <i class="fa fa-plus fr"></i>
            </a>
            <div class="hide">
                <p><a href="<?php echo INDEX ?>/admin.php?mod=userset">随机用户-昵称设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=setvip">VIP会员价位设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=setdiam">金币价位设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=card">兑换卡设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=signin">签到设置</a></p>
                <p><a href="<?php echo INDEX ?>/admin.php?mod=set">系统设置</a></p>
                
            </div>
        </li>
        <div class="clear"></div>
    </ul>
</div>
