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
                    <h4 class="modal-title" id="myModalLabel">Add Role</h4>
                </div>
                <div class="modal-body">
                    <div class="model-item">
                        <label for="id">Role</label>
                        <input type="text" id="role">
                    </div>
                    <form>
                    @foreach($menus as $val)
                        <div><strong>{{$val['title']}}</strong></div>
                        @if($val['children'])
                        @foreach($val['children'] as $child)
                            <input type="checkbox" value="{{$child['mid']}}" name="{{$child['title']}}">
                            <span>{{$child['title']}}</span>
                        @endforeach
                        @endif
                    @endforeach
                    </form>
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
                <h4 class="modal-title" id="myModalLabel">Edit Role</h4>
            </div>
            <div class="modal-body">
                <div class="model-item">
                    <label for="id">Role</label>
                    <input type="text" id="role2">
                </div>
                <form>
                    @foreach($menus as $val)
                        <div><strong>{{$val['title']}}</strong></div>
                        @if($val['children'])
                            @foreach($val['children'] as $child)
{{--                                @if($rights)--}}
                                <input type="checkbox" value="{{$child['mid']}}" name="{{$child['title']}}" class="edit"
{{--                                    {{ in_array($child['mid'],$list[$val[]])? 'checked':''}}--}}
                                     >
{{--                                @endif--}}
                                <span>{{$child['title']}}</span>
                            @endforeach
                        @endif
                    @endforeach
                </form>
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
        data.role = $('#role').val().trim();
        data.rights = $('form').serialize();
        // data.status = $('#status').is(':checked')?1:0;
        if(data.role===''){
            alert('Role title is required!');
        }
        $.post(
            'http://localhost:8080/xpcms/xpcms/public/admins/groups/save',
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
        $('#role2').attr('value',$admin.title);
        let rights=[];
        rights = $.parseJSON($admin.rights);
        let a = $('.edit');
        for(let key in rights){
            for(let i=0;i<a.length;i++){
                if($(a[i]).attr('value')==rights[key]){
                    $(a[i]).prop('checked',true);
                }
            }
        }
        $('#myModal2').on('hidden.bs.modal', function () {
            let a = $('.edit');
            for(let i=0;i<a.length;i++){
                $(a[i]).prop('checked',false);
            }
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
            $('form').serializeArray(),
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
