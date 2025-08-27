var isover = false;
var hostname = window.location.hostname
var port = window.location.port || '80';
var ServerUrl = "http://18.163.141.205:2000/uploads";


$(function(){
    uploader.on('all', function (type) {
        
        if (type === 'startUpload') {
            state = 'started';
            console.log("开始上传了~");
        } else if (type === 'stopUpload') {
            state = 'stoped';
            console.log("开始暂停了~");
        } else if (type === 'uploadFinished') {
            state = 'finished';
            isover = true;
        }
    });
    $('.button').click(function(){
        // var inputs =  $("input[name=check_box]");
        // var array = [];
        // for(var i = 0;i<inputs.length;i++){
        //     if(inputs[i].checked){
        //         array.push($(inputs[i]).attr('rel'));
        //     }
        // }
        // $('.typeid').val(array);
        // $('.vidtype').val($("input[type=radio]:checked").val());
       
        ajax("acddvbx",$('.wrap textarea,.wrap input'));
    });
});
var post_flag = false; 
function ajax(target,data){
    if(post_flag) return; post_flag = true;
    data = data;
	$.ajax({
		type: "post",
		url: "/appajax.php?mod="+target,
		dataType: 'json',
		data: data,
		success: function(data){
            if(data.err){
                alert(data.err);
            }else if(data.success){
                $('.wrap').remove();
                $('.wwww').show()
            }else{
                alert("未知错误");
            }
            post_flag =false;
        },
		error: function() {
            post_flag =false;
        },
        beforeSend: function() {
            
        }
   })
}