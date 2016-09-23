$().ready(function() {  
    $(".validate_form").validate();  
});
// ajax 异步提交表单
$(".ajax_form").submit(function(){
    var obj  = $(this);
    if ( obj.hasClass("submitWait") ) {return false;}
    var url  = obj.attr("action");
    var name = '';
    $.each( obj.find("button[type='submit']"), function(){
        obj.addClass("submitWait");
    });
    layer.load(0, {shade: false});
    $.ajax({
        url:url,
        type:'POST',
        data:$(this).serialize(),
        dataType:'json',
        success:function(data){
            obj.removeClass("submitWait");
            $('.layui-layer-loading').remove();
            if(data['code'] == 1){
                layer.msg(data['msg'], {icon: 1}); 
                setTimeout(function(){
                    window.location.href=data['url']; 
                },1500);
            }else{
                layer.msg(data['msg'], {icon: 2});
            }
        },
        error:function(msg){
            obj.removeClass("submitWait");
            layer.msg('网络错误', {icon: 2});
        }
    });
    return false;
});