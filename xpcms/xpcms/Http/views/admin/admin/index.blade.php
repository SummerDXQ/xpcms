<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                        <td>{{$item->id}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->real_name}}</td>
                        <td>{{$group[$item->group_id]}}</td>
                        <td>{{$item->login_lasttime? date('d/m/yy h:i:s',$item->login_lasttime):''}}</td>
                        <td>{!!$item->status==0? 'Usable':'<span style="color:red;">Disabled</span>'!!}</td>
                        <td><button>del</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
