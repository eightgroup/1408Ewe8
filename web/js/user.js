/**
 * Created by Administrator on 2016/6/13 0013.
 */
function witch(cont){
    $.post('index.php?r=js/witch',{id:cont},function(data){
        $.post('index.php?r=js/public',function(data){
            $('#hehe').html(data)
        })
        $('#mypublic').html("<small>您当前操作的是,</small>"+data);
    })
}
$(function(){
    $.post('index.php?r=js/user',function(data){
       $('#loginname').html(data)
    })
    $.post('index.php?r=js/public',function(data){
        $('#hehe').html(data)
    })
    $.post('index.php?r=js/current',function(data){
        $('#mypublic').html(data)
    })
})
