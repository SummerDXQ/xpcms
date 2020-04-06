<?php
namespace xpcms\Http\Controllers\admins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Groups extends Controller{
    public function index(){
        $data['lists'] = DB::table('xpcms_admin_group')->lists();
        return view('admin.groups.index',$data);
    }
}
