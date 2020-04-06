<?php


namespace xpcms\Http\Controllers\admins;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

// Menu management
class Menus extends Controller
{
    public function index(Request $req){
        $pid = (int)$req->pid;
        $data['list'] = DB::table('xpcms_admin_menu')->where('pid',$pid)->lists();
        return view('admin.menus.index',$data);
    }

    public function save(Request $req){
        $data['title'] = $req->title;
        $data['ord'] = (int)$req->ord;
        $data['controller'] = trim($req->controller);
        $data['action'] = trim($req->action);
        $data['ishidden'] =(int)$req->ishidden;
        $data['status'] =(int)$req->status;
        $data['admin_id'] = $req->admin['id'];
        if($data['title']==''){
            exit(json_encode(['code'=>1,'msg'=>'Menu title is required!']));
        }
        DB::table('xpcms_admin_menu')->insert($data);
        exit(json_encode(['code'=>0,'msg'=>'Save successfully!']));
    }
    public function edit_save(Request $req){
        $data['mid'] = (int)trim($req->mid);
        $data['title'] = trim($req->title);
        $data['ord'] = (int)trim($req->ord);
        $data['controller'] = trim($req->controller);
        $data['action'] = trim($req->action);
        $data['ishidden'] = (int)trim($req->ishidden);
        $data['status'] = (int)trim($req->status);
        if($data["title"]==''){
            exit(json_encode(['code'=>1,'msg'=>'Menu title is required!']));
        }
        DB::table('xpcms_admin_menu')->where('mid',$data['mid'])->update($data);
        exit(json_encode(['code'=>0,'msg'=>'Update successfully!']));
    }

    public function del(Request $req){
        $mid = $req->mid;
        DB::table('xpcms_admin_menu')->where('mid',$mid)->delete();
        exit(json_encode(['code'=>0,'msg'=>'Delete successfully!',$mid]));
    }

}
