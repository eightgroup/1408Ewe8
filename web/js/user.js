/**
 * Created by Administrator on 2016/6/13 0013.
 */
function witch(cont){
    $.post(a,{id:cont},function(data){
        $.post(b,function(data){
            $('#hehe').html(data)
        })
        $('#mypublic').html("<small>您当前操作的是,</small>"+data);
    })
}
$(function(){
    $.post(d,function(data){
       $('#loginname').html(data)
    })
    $.post(b,function(data){
        $('#hehe').html(data)
    })
    $.post(c,function(data){
        $('#mypublic').html(data)
    })
})
