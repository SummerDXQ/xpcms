<?php
namespace xpcms\Http\Controllers\admins;
use Illuminate\Http\Request;
use xpcms\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Site extends Controller
{
    //SEO Setting
    public function seo(){
        $item = DB::table('xpcms_sys_setting')->where('keys','site_seo')->item();
        $data['values'] = json_decode($item['values'],true);
        return view('admin.site.index',$data);
    }
    public function seo_save(Request $req){
        parse_str($req->values,$arr);
        $keys = $arr['__keys'];
        $data['title'] = $arr['title'];
        $data['keywords'] = $arr['keywords'];
        $data['description'] = $arr['description'];
        $item = DB::table('xpcms_sys_setting')->where('keys',$keys)->item();
        if($item){
            DB::table('xpcms_sys_setting')->where('keys',$keys)->update(['values'=>json_encode($data)]);
            exit(json_encode(['code'=>0,'msg'=>'Update Successfully']));
        }
        DB::table('xpcms_sys_setting')->insert(['keys'=>$keys,'values'=>json_encode($data)]);
        exit(json_encode(['code'=>0,'msg'=>'Save Successfully']));
    }
}
