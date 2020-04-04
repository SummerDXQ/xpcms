<?php


namespace xpcms\Http\Controllers\admins;


use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Admin extends Controller
{
    public function index(){
        //admin list
        $data['list'] = DB::table('xpcms_admin')->get()->all();
        $tmp = DB::table('xpcms_admin_group')->get()->all();
        $groups = [];
        foreach ($tmp as $key=>$value){
            $groups[$value->gid] = $value->title;
        }
//        foreach ($data['list'] as $key=>$value){
//            $value->group_title = $groups[$value->group_id];
//            $data['list'][$key] = $value;
//        }
        $data['group']=$groups;
        return view('admin.admin.index',$data);
    }
}
