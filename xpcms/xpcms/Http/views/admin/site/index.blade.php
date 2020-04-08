<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <title>SEO Setting</title>
    <style>
        label{
            display: inline-block;
            width: 10%;
            margin-right: 5px;
            text-align: center;
        }
        input{
            width: 80%;
            height: 20px;
        }
        .item{
            margin: 10px;
        }
        button{
            float: right;
            margin-right: 100px;
            background: #1d68a7;
            color: #fff;
            width: 50px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div>
        <div style="margin: 20px">SEO Setting</div>
        @csrf
        <form>
            <input type="hidden" name="__keys" value="site_seo">
            <div class="item">
                <label>Website Title:</label>
                <input type="text" name="title" placeholder="Please enter website title" value="{{$values['title']}}">
            </div>
            <div class="item">
                <label>Keywords:</label>
                <input type="text" name="keywords" placeholder="Please enter keywords" value="{{$values['keywords']}}">
            </div>
            <div class="item">
                <label>Description:</label>
                <input type="text" name="description" placeholder="Please enter description" value="{{$values['description']}}">
            </div>
        </form>
        <button onclick="save()">Save</button>
    </div>
    <script>
        function save() {
            let data = new Object();
            data._token = $('input[name="_token"]').val();
            data.values = $('form').serialize();
            $.post(
                'http://localhost:8080/xpcms/xpcms/public/admins/site/seo_save',
                data,
                function (res) {
                    if(res.code>0){
                        alert(res.msg);
                    }
                    alert(res.msg);
                    setTimeout(function () {
                        window.location.reload();
                    },1000)
                },
                'json'
            )
        }
    </script>
</body>
</html>
