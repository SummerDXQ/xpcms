<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        table,th,td
        {
            border:1px solid black;
        }
        label{
            display: inline-block;
            width: 75px;
            margin-right: 5px;
            text-align: center;
        }
        .model-item{
            margin: 10px;
        }
        input{
            width: 80%;
        }
        select{
            width: 80%;
        }
    </style>
</head>
<body>
<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add</button>

    <!-- Modal -->
    @csrf
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
                </div>
                <div class="modal-body">
                    <div class="model-item">
                        <label for="id">ID</label>
                        <input type="text" id="id">
                    </div>
                    <div class="model-item">
                        <label for="Password">Password:</label>
                        <input type="text" id="password">
                    </div>
                    <div class="model-item">
                        <label for="Role">Role:</label>
                        <select id="group_id">
{{--                            @foreach($groups as $item)--}}
{{--                                <option value="{{$item['gid']}}">{{$item['title']}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
                    <div class="model-item">
                        <label for="Name">Name:</label>
                        <input type="text" id="real_name">
                    </div>
                    <div class="model-item">
                        <label for="Phone">Phone:</label>
                        <input type="text" id="phone">
                    </div>
                    <div class="model-item">
                        <label for="Setting">Setting:</label>
                        <input type="checkbox" title="disabled" value="1" id="status">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Operation</th>
        </tr>
        <tbody>
        @foreach($lists as $item)
            <tr>
                <td>{{$item['gid']}}</td>
                <td>{{$item['title']}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" onclick="edit({{json_encode($item)}})">Edit</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Admin</h4>
            </div>
            <div class="modal-body">
                <div class="model-item">
                    <label for="username2">Username:</label>
                    <input type="text" id="username2" disabled>
                </div>
                <div class="model-item">
                    <label for="password2">Password:</label>
                    <input type="text" id="password2">
                </div>
                <div class="model-item">
                    <label for="Role">Role:</label>
                    <select id="group_id2">
{{--                        @foreach($groups as $item)--}}
{{--                            <option value="{{$item['gid']}}">{{$item['title']}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>
                <div class="model-item">
                    <label for="real_name2">Name:</label>
                    <input type="text" id="real_name2">
                </div>
                <div class="model-item">
                    <label for="phone2">Phone:</label>
                    <input type="text" id="phone2">
                </div>
                <div class="model-item">
                    <label for="Setting">Setting:</label>
                    <input type="checkbox" title="disabled" id="status2">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="edit_save();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function save() {
        let data = new Object();
        data._token = $('input[name="_token"]').val();
        data.username = $('#username').val().trim();
        data.password = $('#password').val().trim();
        data.group_id = $('#group_id').val().trim();
        data.real_name = $('#real_name').val().trim();
        data.phone = $('#phone').val().trim();
        data.status = $('#status').is(':checked')?1:0;
        if(data.username===''){
            alert('Username is required!');
        }
        if(data.password===''){
            alert('Password is required!');
        }
        if(data.group_id==='0'){
            alert('Group ID is required!');
        }
        $.post(
            'http://localhost:8080/xpcms/xpcms/public/admins/admin/save',
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
    function edit($admin) {
        $('#myModal2').on('show.bs.modal', function () {
            $('#username2').attr('value',$admin.username);
            $('#real_name2').attr('value',$admin.real_name);
            $('#phone2').attr('value',$admin.mobile);
            $('#password2').attr('value',$admin.password);
            $admin.status===1? $('#status2').attr('checked','checked'):'';
        });
    }

    function edit_save() {
        let data = new Object();
        data._token = $('input[name="_token"]').val();
        data.username = $('#username2').val().trim();
        data.password = $('#password2').val().trim();
        data.group_id = $('#group_id2').val().trim();
        data.real_name = $('#real_name2').val().trim();
        data.phone = $('#phone2').val().trim();
        data.status = $('#status2').is(':checked')?1:0;
        if(data.username===''){
            alert('Username is required!');
        }
        if(data.group_id==='0'){
            alert('Group ID is required!');
        }
        $.post(
            'http://localhost:8080/xpcms/xpcms/public/admins/admin/edit_save',
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
