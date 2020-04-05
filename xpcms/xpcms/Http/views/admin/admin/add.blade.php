<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
    </div>
    <div class="modal-body">
        <div class="model-item">
            <label for="Username">Username:</label>
            <input type="text" id="username">
        </div>
        <div class="model-item">
            <label for="Password">Password:</label>
            <input type="text" id="password">
        </div>
        <div class="model-item">
            <label for="Role">Role:</label>
            <select id="group_id">
{{--                @foreach($groups as $item)--}}
{{--                    <option value="{{$item['gid']}}">{{$item['title']}}</option>--}}
{{--                @endforeach--}}
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
