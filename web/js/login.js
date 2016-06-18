/**
 * Created by Administrator on 2016/6/12 0012.
 */
/*用于验证用户*/
    function fun_username(obj){
       var username= document.getElementById('username').value
       if(username==''){
           document.getElementById('tishi').innerHTML='请输入必填字段'
           return false
       }else{
           document.getElementById('tishi').innerHTML=''
           return true
       }
    }
    function fun_pwd(obj) {
        var pwd= document.getElementById('pwd').value
        if (pwd == '') {
            document.getElementById('tishi').innerHTML = '请输入必填字段'
            return false
        } else {
            document.getElementById('tishi').innerHTML=''
            return true
        }
    }
    function fun_logon(){
        if(fun_username()&fun_pwd()){
            var username= document.getElementById('username').value
            var pwd= document.getElementById('pwd').value
            var remember= document.getElementById('remember').value;
            $.post(url,{username:username,pwd:pwd,remember:remember}, function(data){
                if(data){
                    //alert(data)
                    location.href=url1
                }else{
                    document.getElementById('tishi').innerHTML = '您的账号或者密码错误'
                }
            });
        }
    }