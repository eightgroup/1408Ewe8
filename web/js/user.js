/**
 * Created by Administrator on 2016/6/13 0013.
 */
$(function(){
    $.post('index.php?r=js/user',function(data){
       $('#loginname').html(data)
    })
    $.post('index.php?r=js/public',function(data){
        $('#hehe').html(data)
    })
    $.post('index.php?r=js/public',function(data){
        $('#hehe').html(data)
    })
})
