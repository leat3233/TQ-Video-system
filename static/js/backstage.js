$(function(){
    $('.aside ul li a').click(function(){
        $attr = $(this).next('div').attr('class');
        if($attr=='hide'){
            $('.aside ul li div').addClass('hide');
            $(this).addClass('open');
            $(this).find('i.fa-plus').attr('class','fa fa-minus fr');
            $(this).next('div').stop().slideDown('fast').removeClass('hide').addClass('open');
        }else{
            $(this).removeClass('open');
            $(this).find('i.fa-minus').attr('class','fa fa-plus fr');
            $(this).next('div').stop(true).slideUp('fast').addClass('hide').removeClass('open');
        }
    });
    $('.content a.btn.submit').click(function(){
        ajax($(this).attr('rel'));
    });
    $('.content a.btn.del').click(function(){
    	if(confirm('请再次确认是否真的删除?')){
    		ajax('delete',"id="+$(this).attr('id')+"&table="+$(this).attr('rel'));
    	}
    });
    
    $('.tologin').click(function(){
    	ajax('login');
    });
    $('.logout').click(function(){
    	if(confirm('请再次确认是否真的登出?')){
    		ajax('logout');
    	}
    });
    $('.cleardata').click(function(){
    	if(confirm('清除后未使用的兑换卡会失效,已使用的不受影响,是否继续?')){
    		ajax('cleardata');
    	}
    });
    
    $('a[rel=addtopic]').click(function(){
        ajax($(this).attr('rel'),$('table.addtopic input'));
    });
    $('a[rel=addapp]').click(function(){
        ajax($(this).attr('rel'),$('table.addtopic input'));
    });
    $('a[rel=addapps]').click(function(){
        ajax($(this).attr('rel'),$('table.addtopic input'));
    });
    
    $('.content a.btn.init').click(function(){
        if(confirm('初始化后,数据自动重置, 请再次确认!')){
    	    ajax($(this).attr('rel'));
        }
    });
    $('a[rel=updatetopic]').click(function(){
    	var name = $(this).parent('td').parent('tr').find('input[name=name]').val();
    	var cover = $(this).parent('td').parent('tr').find('input[mode=upload]').val();
    	var desces = $(this).parent('td').parent('tr').find('input[name=desces]').val();
    	var hot = $(this).parent('td').parent('tr').find('input[name=hot]').val();
    	ajax($(this).attr('rel'),"topicid="+$(this).attr('topicid')+"&name="+name+"&cover="+cover+"&desces="+desces+"&hot="+hot);
    });
    $('a[rel=updateapp]').click(function(){
    	var name = $(this).parent('td').parent('tr').find('input[name=name]').val();
    	var cover = $(this).parent('td').parent('tr').find('input[mode=upload]').val();
    	var desces = $(this).parent('td').parent('tr').find('input[name=desces]').val();
    	var num = $(this).parent('td').parent('tr').find('input[name=num]').val();
    	var downloadurl = $(this).parent('td').parent('tr').find('input[name=downloadurl]').val();
    	ajax($(this).attr('rel'),"appid="+$(this).attr('appid')+"&name="+name+"&cover="+cover+"&desces="+desces+"&num="+num+"&downloadurl="+downloadurl);
    });
    $('a[rel=updateapps]').click(function(){
    	var name = $(this).parent('td').parent('tr').find('input[name=name]').val();
    	var cover = $(this).parent('td').parent('tr').find('input[mode=upload]').val();
    
    	var downloadurl = $(this).parent('td').parent('tr').find('input[name=downloadurl]').val();
    	ajax($(this).attr('rel'),"appid="+$(this).attr('appid')+"&name="+name+"&cover="+cover+"&downloadurl="+downloadurl);
    });
    $('a[rel=updatevip]').click(function(){
    	var stit = $(this).parent('td').parent('tr').find('input[name=stit]').val();
    	var btit = $(this).parent('td').parent('tr').find('input[name=btit]').val();
    	var oldprice = $(this).parent('td').parent('tr').find('input[name=oldprice]').val();
    	var nowprice = $(this).parent('td').parent('tr').find('input[name=nowprice]').val();
    	var descs = $(this).parent('td').parent('tr').find('input[name=descs]').val();
    	var adddiam = $(this).parent('td').parent('tr').find('input[name=adddiam]').val();
    	var days = $(this).parent('td').parent('tr').find('input[name=days]').val();
    	ajax($(this).attr('rel'),"vipcardid="+$(this).attr('vipcardid')+"&stit="+stit+"&btit="+btit+"&oldprice="+oldprice+"&nowprice="+nowprice+"&descs="+descs+"&adddiam="+adddiam+"&days="+days);
    });
    $('a[rel=updatediam]').click(function(){
    	var diamnum = $(this).parent('td').parent('tr').find('input[name=diamnum]').val();
    	var give = $(this).parent('td').parent('tr').find('input[name=give]').val();
    	var price = $(this).parent('td').parent('tr').find('input[name=price]').val();
    	var descs = $(this).parent('td').parent('tr').find('input[name=descs]').val();
    	var tag = $(this).parent('td').parent('tr').find('input[name=tag]').val();

    	ajax($(this).attr('rel'),"diamcardid="+$(this).attr('diamcardid')+"&diamnum="+diamnum+"&give="+give+"&price="+price+"&descs="+descs+"&tag="+tag);
    });
    $('a[rel=updatequestion]').click(function(){
    	var q = $(this).parent('td').parent('tr').find('input[name=question]').val();
    	var a = $(this).parent('td').parent('tr').find('input[name=answer]').val();
    	ajax($(this).attr('rel'),"qaid="+$(this).attr('qaid')+"&q="+q+"&a="+a);
    });
    $('a[rel=setpay]').click(function(){
        var tel = $(this).attr('tel');
        var money = $(this).attr('money');
        var msg = "将为用户: "+tel+" 设置成已打款状态, 该用户账户将扣除"+money+"元!";
        if(confirm(msg)){
            ajax($(this).attr('rel'),"id="+$(this).attr('id')+"&tel="+tel+"&money="+money);
        }
    });
    $('a[rel=updatesignin]').click(function(){
    	var rewardtype = $(this).parent('td').parent('tr').find('select[name=rewardtype]').val();
    	var reward = $(this).parent('td').parent('tr').find('input[name=reward]').val();
    	ajax($(this).attr('rel'),"id="+$(this).attr('id')+"&rewardtype="+rewardtype+"&reward="+reward);
    });
    
    
    
    $('a.upload').click(function(){
    	upload($(this).parent(),$(this).prev("input[mode=upload]"));
    });
    $('.pub_select,.topic_select,.flag_select').click(function(){
    	$(this).next('ul').toggle();
    });
    $('.pub_select').next('ul').find('li').click(function(){
    	$(this).parent().hide();
    	$(this).parent().prev().val($(this).text());
    });
    $('.topic_select').next('ul').find('li').click(function(){
    	$(this).parent().hide();
    	var curdata = $(this).parent().prev().val();
    	var content = $(this).text();
    	if(curdata.indexOf(content)!=-1){
    	    alert("该话题已存在");return;
    	}
    	if(curdata.includes("|")){
        	alert('最多只能加两个话题!');
        }else{
            if(curdata){
                var view = '|';
            }else{
                var view = '';
            }
            $(this).parent().prev().val(curdata+view+content);
        }
    	
    });
    $('.flag_select').next('ul').find('li').click(function(){
    	$(this).parent().hide();
    	var curdata = $(this).parent().prev().val();
    	var content = $(this).text();
    	if(curdata.indexOf(content)!=-1){
    	    alert("该属性已存在");return;
    	}
    	if(content.indexOf("VIP")!=-1){
    	    var vipdiam = $("input[name=vipdiam]").val();
    	    var diamond = $("input[name=diamond]").val();
    	    if(parseInt(diamond)<1){
    	        alert("免费影片不可选择VIP类标签");return;
    	    }
    	    if(parseInt(vipdiam)>0){
    	        alert("含有VIP字眼的属性,VIP用户钻石价格-必须为0");return;
    	    }
    	}
    	if(content.indexOf("钻石")!=-1){
    	    var vipdiam = parseInt($("input[name=vipdiam]").val());
    	    var diamond = parseInt($("input[name=diamond]").val());
    	    if(diamond<1){
    	        alert("免费影片不可选择钻石类标签");return;
    	    }
    	    if(vipdiam<1 || vipdiam>diamond){
    	        alert("含有钻石字眼的属性,VIP用户【钻石价格必须>0】且【必须小于普通用户钻石价格】");return;
    	    }
    	}
    	
    	
    	
    	
    	if(curdata){
            var view = '|';
        }else{
            var view = '';
        }
        $(this).parent().prev().val(curdata+view+content);
    	
    });
    $('.ishow').click(function(){
        if(confirm('请再次确认是否全部审核通过?')){
            var array = [];
            for(var i = 0;i<inputs.length;i++){
                if(inputs[i].checked){
                    array.push($(inputs[i]).attr('rel'));
                }
            }
            var mod = $(this).attr('rel');
           
            ajax('ishow',"modd="+mod+"&idlist="+array);
        }
        

    });
    $('.ishowww').click(function(){
        if(confirm('请再次确认是否全部审核通过?')){
            var array = [];
            for(var i = 0;i<inputs.length;i++){
                if(inputs[i].checked){
                    array.push($(inputs[i]).attr('rel'));
                }
            }
           
            ajax('fromcommentslist',"modd=fromcommentslist&idlist="+array);
        }
        

    });
});
function upload(form,show){
	$.ajax({
            url:'/webajax.php?modd=upload',
            data: new FormData($(form)[0]),
            type: 'POST',    
            async: true,    
            cache: false,    
            contentType: false,    
            processData: false,    
            success: function (ret) {
            	show.val(ret);
            },
            beforeSend:function(){
                show.val('正在上传,请稍后...');
            },
            error: function (ret) {  
                show.val('上传错误');
            }
        });
}
var post_flag = false; 
function ajax(target,data){
    if(post_flag) return; post_flag = true;
    if(data){
    	data = data;
    }else{
    	data = $('input,textarea,select').serialize();
    }
   
    $.ajax({
		type: "post",
		url: "/webajax.php?modd="+target,
		dataType: 'html',
		data: data,
		success: function(data){
            $('.message').remove();
            $('body').append(data); 
            post_flag =false;
        },
		error: function() {
            post_flag =false;
        },
        beforeSend: function() {
            
        }
   })
}
