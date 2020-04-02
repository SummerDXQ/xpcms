<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台登陆</title>
    <script src="http://localhost:8080/xpcms/xpcms/public/js/jquery3.4.1.js"></script>
    <style>
        body{
            background: #1E9FFF
        }
        .container{
            background: #fff;
            width: 480px;
            height: 300px;
            position: absolute;
            left: 50%;
            top: 200px;
            margin-left: -240px;
            border-radius: 4px;
            box-shadow: 5px 5px 20px #444444;
            padding: 20px;
        }
        .container .title{
            font-size: 18px;
            color: grey;
        }
        .form{
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }
        .form_item{
            margin: 15px;
            font-size: 16px;
            position: relative;
        }
        label{
            display: inline-block;
            width: 75px;
            margin-right: 5px;
            text-align: center;
        }
        button{
            background: #38c172;
            margin: 20px;
            width: 80px;
            height: 30px;
            align-self: flex-end;
            color: #fff;
            font-size: 16px;
        }
        input{
            width: 100px;
        }
        img{
            position: absolute;
            top: -10px;
            left: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        @csrf
        <p class="title">XPCMS Management System</p>
        <div class="form">
            <div class="form_item">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form_item">
                <label for="Password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form_item">
                <label for="verification">verification</label>
                <input type="text" name="verification" id="verification">
                <img src="http://localhost:8080/xpcms/xpcms/public/admins/account/captcha" id="captcha" style="border: 1px solid #cdcdcd;cursor:pointer;" onclick="reload_captcha()">
            </div>
            <button onclick="doLogin()">Login</button>
        </div>
    </div>

    <script>
        function reload_captcha(){
            $('#captcha').attr('src','http://localhost:8080/xpcms/xpcms/public/admins/account/captcha?rand='+Math.random());
        }

        function doLogin() {
            // console.log('click');
            // console.log($('#username').val());
            let username = $('#username').val().trim();
            let password = $('#password').val().trim();
            let verifyCode = $('#verification').val().trim();
            let _token=$('input[name="_token"]').val();
            if(username===''){
                alert('Username is required!')
            }
            if(password===''){
                alert('password is required!')
            }
            if(verifyCode===''){
                alert('verifyCode is required!')
            }
            $.post(
                'http://localhost:8080/xpcms/xpcms/public/admins/account/doLogin',
                {username:username,password:password,verifyCode:verifyCode,_token:_token},
                function (res) {
                    console.log('request successfully');
                    reload_captcha();
                    if(res.code>0){
                        console.log(res.result);
                        alert(res.msg);
                    }else{
                        console.log('登陆成功');
                        alert(res.msg);
                        setTimeout(function () {
                            window.location.href='http://localhost:8080/xpcms/xpcms/public/admins/home/index';
                        },2000)
                    }
                },
                'json');
        }
    </script>
</body>
</html>
