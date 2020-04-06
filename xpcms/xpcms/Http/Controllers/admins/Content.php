<?php
namespace xpcms\Http\Controllers\admins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use xpcms\Http\Controllers\Controller;

class Content extends Controller{
    public function index(){
        $data = DB::table('xpcms_article')->pages(1);
//        $article = $pageObj->items();
//        $result=[];
//        foreach ($article as $key=>$value){
//            $result[]=(array)$value;
//        }
//        //total lists
//        $data['lists'] = $result;
//        //total pages
//        $data['total'] = $pageObj->total();
//        //html page number
//        $data["links"] = $pageObj->links('admin.public.paginate');
        return view('admin.content.index',$data);
//        echo '<pre>';
//        print_r($article);
//        return view('admin.groups.index',$data);
    }
}
