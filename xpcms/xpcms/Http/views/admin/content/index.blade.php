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
    <title>Menu Management</title>
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

        /*select{*/
        /*    width: 80%;*/
        /*}*/
        input[type='checkbox']{
            width: 5%;
        }
        .search{
            width: 20%;
        }
    </style>
</head>
<body>
<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add</button>
    <div style="margin: 10px">
        <select id="group_id">
            @foreach($lists as $item)
                <option value="{{$item['id']}}">{{$item['title']}}</option>
            @endforeach
        </select>
        <input type="text" id="" placeholder="Search" class="search">
        <button>Search</button>
    </div>
    <!-- Modal -->
    @csrf
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="model-item">
                        <label for="menu">Menu:</label>
                        <input type="text" id="menu">
                    </div>
                    <div class="model-item">
                        <label for="ord">Order:</label>
                        <input type="text" id="ord">
                    </div>
                    <div class="model-item">
                        <label for="controller">Controller:</label>
                        <input type="text" id="controller">
                    </div>
                    <div class="model-item">
                        <label for="action">Action:</label>
                        <input type="text" id="action">
                    </div>
                    <div class="model-item">
                        <label for="status">Status:</label>
                        <input type="checkbox" title="Hidden" value="1" id="ishidden">Hidden
                        <input type="checkbox" title="Disabled" value="1" id="status">Disable
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
            <th>Title</th>
            <th>Author</th>
            <th>Edit Time</th>
            <th>Status</th>
            <th>Operation</th>
        </tr>
        <tbody>
        @foreach($lists as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item["title"]}}</td>
                <td>{{$item["author"]}}</td>
                <td>{{$item["edit_time"]}}</td>
                <td>{{$item["status"]}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" onclick="edit({{json_encode($item)}})">Edit</button>
                    <button onclick="del({{$item['id']}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$links}}
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
            </div>
            <div class="modal-body">
                <div class="model-item">
                    <label for="menu">Menu ID:</label>
                    <input type="text" id="mid" disabled>
                </div>
                <div class="model-item">
                    <label for="menu">Menu:</label>
                    <input type="text" id="menu2">
                </div>
                <div class="model-item">
                    <label for="ord">Order:</label>
                    <input type="text" id="ord2">
                </div>
                <div class="model-item">
                    <label for="controller">Controller:</label>
                    <input type="text" id="controller2">
                </div>
                <div class="model-item">
                    <label for="action">Action:</label>
                    <input type="text" id="action2">
                </div>
                <div class="model-item">
                    <label for="status">Status:</label>
                    <input type="checkbox" title="Hidden" value="1" id="ishidden2">Hidden
                    <input type="checkbox" title="Disabled" value="1" id="status2">Disabled
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
        data.title = $('#menu').val().trim();
        data.ord = $('#ord').val()==''? '':$('#ord').val().trim();
        data.controller = $('#controller').val()==''? '':$('#controller').val().trim();
        data.action = $('#action').val()==''? '':$('#action').val().trim();
        data.ishidden = $('#ishidden').is(':checked')?1:0;
        data.status = $('#status').is(':checked')?1:0;
        // alert(data.controller);
        // alert(data.action);

        if(data.title===''){
            alert('Menu title is required!');
        }
        $.post(
            'http://localhost:8080/xpcms/xpcms/public/admins/menus/save',
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
            $('#mid').attr('value',$admin.mid);
            $('#menu2').attr('value',$admin.title);
            $('#ord2').attr('value',$admin.ord);
            $('#controller2').attr('value',$admin.controller);
            $('#action2').attr('value',$admin.action);
            $admin.ishidden===1? $('#ishidden2').attr('checked','checked'):'';
            $admin.status===1? $('#status2').attr('checked','checked'):'';
        });
    }

    function edit_save() {
        let data = new Object();
        data._token = $('input[name="_token"]').val();
        data.mid = $('#mid').val().trim();
        data.title = $('#menu2').val().trim();
        data.ord = $('#ord2').val().trim();
        data.controller = $('#controller2').val().trim();
        data.action = $('#action2').val().trim();
        // data.phone = $('#phone2').val().trim();
        data.ishidden = $('#ishidden2').is(':checked')?1:0;
        data.status = $('#status2').is(':checked')?1:0;
        if(data.title===''){
            alert('Menu title is required!');
        }
        $.post(
            'http://localhost:8080/xpcms/xpcms/public/admins/menus/edit_save',
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
    function del($menu_id) {
        let data = new Object();
        data._token = $('input[name="_token"]').val();
        data.mid=$menu_id;
        if(confirm('Delete?')){
            $.post(
                'http://localhost:8080/xpcms/xpcms/public/admins/menus/del',
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
    }

    //get sub menu
    function child(pid) {
        window.location.href = '?pid=' + pid;
    }


</script>
</body>
</html>
