<?php


namespace xpcms\Http\Controllers\admins;


use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Admin extends Controller
{
    public function index(){
        //admin list, lists and myFunc are customized functions
        $data['list'] = DB::table('xpcms_admin')->lists();
        $data['groups']=DB::table('xpcms_admin_group')->myFunc('gid');
        return view('admin.admin.index',$data);
    }

    public function add(){
        return view('admin.admin.add');
    }
}
