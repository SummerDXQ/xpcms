<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://localhost:8080/xpcms/xpcms/public/js/jquery3.4.1.js"></script>
    <title>xpcms</title>
    <style>
        *{
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }
        .header{
            background: #1d68a7;
            height: 5vh;
            line-height: 5vh;
            color: #fff;
        }
        a,a:hover,a:focus{
          color: #ffffff;
          text-decoration: none;
        }
        .panel-group {
            background-color: #404040;
            width: 20vw;
            height: 95vh;
            overflow-y: auto;
            padding-top: 50px;
        }
        .panel-group .panel {
            background-color: #404040;
            border: none;
        }

        .panel-heading{
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }
        .panel-default>.panel-heading {
            border: none;
            color: #ffffff;
            background-color: #505050;
        }
        .panel-default>.panel-heading>span{
            font-size: 10px;
        }
        .panel-default>.panel-heading:active,.panel-default>.panel-heading:hover{
            background-color: #4a8bc2;
        }
        .panel-default>.panel-heading>a:hover{
            text-decoration: none;
            background-color: #4a8bc2;
        }
        .panel-group .panel-heading+.panel-collapse>.panel-body {
            border: none;
        }
        .panel-body {
            padding: 0px;
        }
        .nav>li{
            padding: 1px 0px 0px 0px;
        }
        .nav>li>a{
            text-decoration: none;
            padding: 10px 10px 10px 35px;
        }
        .nav>li>a:hover,.nav>li>a:focus{
            background-color: #505050;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="header row">
            <div class="col-3 text-center">
                Welcome to XPCMS
            </div>
            <div class="offset-5 col-4">
                <div class="row text-center">
                    <div class="col-6">Management Center</div>
                    <div class="col-6">admin</div>
                </div>
            </div>
        </div>
        <div>
            <div class="panel-group" id="panelContainer">
                @foreach($menus as $key=>$items)
                <div class="panel panel-default">
                    <div id="header1" class="panel-heading" data-toggle="collapse" data-target="<?php echo '#'?>{{$items->title}}" data-parent="#panelContainer">
                        <a href="#">{{$items->title}}</a>
                    </div>
                    @if($items->children)
                    <div id="{{$items->title}}" class="collapse panel-collapse">
                        <div class="panel-body">
                            <ul class="nav">
                                @foreach($items->children as $val)
                                <li>
                                    <a
                                        href="#"
                                        onclick="menu_fire(this)"
                                        controller="{{$val->controller}}"
                                        action="{{$val->action}}"
                                    >
                                        <span>{{$val->title}}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            <iframe
                style="position: absolute;right: 0px;top: 5vh;height: 95vh;width: 80vw"
                src="http://localhost:8080/xpcms/xpcms/public/admins/home/welcome"
{{--                onload="resetHeight(this)"--}}
            >
            </iframe>
        </div>
    </div>

    <script>
        // function resetHeight(obj){
        //     let left_height = parent.document.documentElement.clientHeight - 141;
        //     $(obj).parent('div').height(left_height);
        // }
        function menu_fire(obj){
            let controller = $(obj).attr('controller').toLowerCase();
            let action = $(obj).attr('action');
            let url='http://localhost:8080/xpcms/xpcms/public/admins/'+controller+'/'+action;
            console.log(url);
            $('iframe').attr('src','http://localhost:8080/xpcms/xpcms/public/admins/'+controller+'/'+action);

        }
        $(function () {

        })
        // $(function() {
        //     $(".panel-heading").on("click", function(e) {
        //         var idLength = e.currentTarget.id.length;
        //         var index = e.currentTarget.id.substr(idLength - 1, idLength);
        //         $("#sub" + index).on('hidden.bs.collapse', function() {
        //             $(e.currentTarget).find("span").removeClass("glyphicon glyphicon-triangle-bottom");
        //             $(e.currentTarget).find("span").addClass("glyphicon glyphicon-triangle-right");
        //         })
        //         $("#sub" + index).on('shown.bs.collapse', function() {
        //             $(e.currentTarget).find("span").removeClass("glyphicon glyphicon-triangle-right");
        //             $(e.currentTarget).find("span").addClass("glyphicon glyphicon-triangle-bottom");
        //         })
        //     })
        //
        //     $(".panel-body > .nav > li > a").on("click", function(e) {
        //         alert(e.currentTarget.textContent);
        //     });
        // });
    </script>
</body>
</html>
