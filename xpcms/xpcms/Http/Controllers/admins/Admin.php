<?php


namespace xpcms\Http\Controllers\admins;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Admin extends Controller
{
    public function index(){
        $data['list'] = DB::table('xpcms_admin')->lists();
        $data['groups']=DB::table('xpcms_admin_group')->myFunc('gid');
        return view('admin.admin.index',$data);
    }

    public function add(){
        return view('admin.admin.add');
    }

    public function save(Request $req){
        $data['username'] = trim($req->username);
        $data['password'] = trim($req->password);
        $data['group_id'] = trim($req->group_id);
        $data['real_name'] = trim($req->real_name);
        $data['mobile'] = trim($req->phone);
        $data['add_time'] =time();
        $data['status'] =(int)$req->status;
        if($data["username"]==''){
            exit(json_encode(['code'=>1,'msg'=>'Username is required!']));
        }
        if($data["password"]==''){
            exit(json_encode(['code'=>1,'msg'=>'Password is required!']));
        }
        $user = DB::table('xpcms_admin')->where("username",$data['username'])->item();
        if($user){
            exit(json_encode(['code'=>1,'msg'=>'The username has already existed!']));
        }
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
        if($data["group_id"]=='0'){
            exit(json_encode(['code'=>1,'msg'=>'Group ID is required!']));
        }
        DB::table('xpcms_admin')->insert($data);
        exit(json_encode(['code'=>0,'msg'=>'Save successfully!']));
    }
    public function edit(Request $req){
        $data['admin_id'] = trim($req->admin_id);
        $res = DB::table('xpcms_admin')->where('id',$data['admin_id'])->item();
        exit(json_encode(['code'=>0,'result'=>$res]));
    }

    public function edit_save(Request $req){
        $data['username'] = trim($req->username);
        $data['password'] = password_hash(trim($req->password),PASSWORD_DEFAULT);
        $data['group_id'] = trim($req->group_id);
        $data['real_name'] = trim($req->real_name);
        $data['mobile'] = trim($req->phone);
        $data['add_time'] =time();
        $data['status'] =(int)$req->status;
        if($data["username"]==''){
            exit(json_encode(['code'=>1,'msg'=>'Username is required!']));
        }
        if($data["group_id"]=='0'){
            exit(json_encode(['code'=>1,'msg'=>'Group ID is required!']));
        }
        DB::table('xpcms_admin')->where('username',$data['username'])->update($data);
        exit(json_encode(['code'=>0,'msg'=>'Update successfully!']));
    }

    public function del(Request $req){
        $id = $req->id;
        DB::table('xpcms_admin')->where('id',$id)->delete();
        exit(json_encode(['code'=>0,'msg'=>'Delete successfully!']));
    }
}
