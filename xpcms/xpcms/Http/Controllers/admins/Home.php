<?php
namespace xpcms\Http\Controllers\admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Home extends Controller{
    public function index(Request $req){
        $data['menus']=$this->get_menus($req->admin);
//        print_r($data['menus']);
//        exit();
        return view('admin.home.index',$data);
    }

    private function get_menus($admin){

//        $admin = Auth::user();
        //loading menus based on rights
//        print_r($admin['rights']);
//        var_dump($admin['rights']);
//        exit();
        $menus = DB::table('xpcms_admin_menu')->where('pid',0)->whereIn('mid',$admin['rights'])->get()->all();

//        print_r($menus);

        foreach ($menus as $key => $val){
            $children = DB::table('xpcms_admin_menu')->where('pid',$menus[$key]->mid)->whereIn('mid',$admin['rights'])->get()->all();
            $menus[$key]->children = $children;
        }
        return $menus;
    }
}
