<?php
namespace xpcms\Http\Controllers\admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Home extends Controller{
    public function index(){
        $data['menus']=$this->get_menus();
        return view('admin.home.index',$data);
    }

    private function get_menus(){
        $menus = DB::table('xpcms_admin_menu')->where('pid',0)->get()->all();
        foreach ($menus as $key => $val){
//            $val = (array($val));
//            echo '<pre>';
//            print_r($val);
//            $menus[$key] = $val;
//            print_r($menus[$key]);
//            echo '<br>';
            $children = DB::table('xpcms_admin_menu')->where('pid',$menus[$key]->mid)->get()->all();
//            print_r($children);
            $menus[$key]->children = $children;
        }
//        echo '<pre>';
//        print_r($menus);
        return $menus;
    }
}
