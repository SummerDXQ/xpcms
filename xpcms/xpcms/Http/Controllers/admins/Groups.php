<?php
namespace xpcms\Http\Controllers\admins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Groups extends Controller{
    public function index(){
        $data['lists'] = DB::table('xpcms_admin_group')->lists();
//        echo '<pre>';
//        print_r($data['lists']);
        $data['menus'] = DB::table('xpcms_admin_menu')->where('status',0)->myFunc('mid');
        $data['menus'] = $this->getTreeItems($data['menus']);
        $results = [];
        foreach ($data['menus'] as $val ){
            $val['children'] = isset($val['children'])? $this->formatMenus($val['children']) : false;
            $results[] = $val;
        }
        $data['menus'] = $results;
//        echo '<pre>';
//        print_r($results);
//        exit(json_encode()$data['menus']);
        return view('admin.groups.index',$data);
    }

    public function edit(Request $req){
        $gid = $req->gid;
        $data['lists'] = DB::table('xpcms_admin_group')->where('gid',$gid)->item();
        $data["rights"] = $data['lists']["rights"];
//        exit(json_encode());
        return view('admin.groups.index',$data);
    }

    // put all submenus in the children menu of its parent menu
    private function getTreeItems($items){
        $tree=[];
        foreach ($items as $key=>$item){
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['children'][] = &$items[$item['mid']];
            }else{
                $tree[] = &$items[$item['mid']];
            }
        }
        return $tree;
    }
    // get two layer structure
    private function formatMenus($items,&$res=array()){
        foreach ($items as $item){
            if(!isset($item['children'])){
                $res[] = $item;
            }else{
                $tmp = $item['children'];
                unset($item['children']);
                $res[] = $item;
                $this->formatMenus($tmp,$res);
            }
        }
        return $res;
    }

    public function save(Request $res){
        $data['title'] = $res->role;
        $rights = $res->rights;
        parse_str($rights,$arr);
        $rights=array_values($arr);
        $data['rights'] = json_encode($rights);
        if(!$data['title']){
            exit(json_encode(['code'=>1,'msg'=>'Role title is required']));
        }
        $results = DB::table('xpcms_admin_group')->lists();
//        exit($right_group);
//        $titles =[];
        foreach ($results as $val){
            $titles[] = $val["title"];
        }
        if(in_array($data['title'],$titles)){
            exit(json_encode(["code"=>1,'msg'=>'The title has existed']));
        }

        DB::table('xpcms_admin_group')->insert($data);
        exit(json_encode(["code"=>0,'msg'=>'Save Successfully!']));
    }
}
