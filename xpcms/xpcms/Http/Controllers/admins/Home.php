<?php
namespace xpcms\Http\Controllers\admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Home extends Controller{
    public function index(Request $req){
        //get data from cache first
//        print_r($req->admin);
//        $hasData = false;
//        if(file_exists($req->admin['username'])){
//            $res = file_get_contents($req->admin['username']);
//            if(!$res==''){
//                $hasData = true;
//            }
//        }
//        if($hasData){
//            $data['menus'] = json_decode($res);
//        }else{
//            //request data from database
//            $data['menus']=$this->get_menus($req->admin);
//            //put the content into cache
//            file_put_contents($req->admin['username'],json_encode($data['menus']));
//        }
//        echo '<pre>';
        $data['menus']=$this->get_menus($req->admin);
//        print_r($data['menus']);
        return view('admin.home.index',$data);
    }

    private function get_menus($admin){
        $menus = DB::table('xpcms_admin_menu')->where('pid',0)->whereIn('mid',$admin['rights'])->get()->all();
        foreach ($menus as $key => $val){
            $children = DB::table('xpcms_admin_menu')->where('pid',$menus[$key]->mid)->whereIn('mid',$admin['rights'])->get()->all();
            $menus[$key]->children = $children;
        }
        return $menus;
    }

    public function welcome(){
        return view('admin.home.welcome');
    }
}
