<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Document</title>
    <style>
        table,th,td
        {
            border:1px solid black;
        }
    </style>
</head>
<body>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Real Name</th>
                <th>Group</th>
                <th>Last Login</th>
                <th>Status</th>
                <th>Operation</th>
            </tr>
            <tbody>
                @foreach($list as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item["username"]}}</td>
                        <td>{{$item["real_name"]}}</td>
                        <td>{{$groups[$item["group_id"]]['title']}}</td>
                        <td>{{$item["login_lasttime"]? date('d/m/yy h:i:s',$item["login_lasttime"]):''}}</td>
                        <td>{!!$item["status"]==0? 'Usable':'<span style="color:red;">Disabled</span>'!!}</td>
                        <td><button>del</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function add() {

        }
    </script>
</body>
</html>
