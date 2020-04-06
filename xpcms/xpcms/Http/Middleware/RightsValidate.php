<?php
namespace xpcms\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RightsValidate{
    public function handle($request,Closure $next){
        $admin = Auth::user();
//        exit(json_encode(['menu'=>$menu]));
        //item() is customized function
        $role = DB::table('xpcms_admin_group')->where('gid',$admin->group_id)->first();
        if(!$role){
            return response($this->_noRights('The role is not exist!',$request),200);
        }
        $role->rights = json_decode($role->rights,true);
        $action = $request->route()->getActionName();
        $actions_arr = explode('@',$action);
        $controllers = explode('\\',$actions_arr[0]);
        $controller = $controllers[count($controllers)-1];
        $action = $actions_arr[1];
        $menu = DB::table('xpcms_admin_menu')->where('controller',$controller)->where('action',$action)->first();
//        exit(json_encode(['menu'=>$menu]));
        if(!$menu){
            return response($this->_noRights('The menu is not exist!',$request),200);
        }
        if(!in_array($menu->mid,$role->rights)){
            return response($this->_noRights('You have no rights!',$request),200);
        }
        if($menu->status==1){
            return response($this->_noRights('The menu has been disabled!',$request),200);
        }
        //pass params to Home controller
        $admin = $admin->toArray();
        $admin['rights'] = $role->rights;
        $request->admin = $admin;
        return $next($request);
    }

    function _noRights($str,$request){
        if($request->ajax()){
            $msg = json_encode(['code'=>1,'msg'=>$str]);
        }else{
            $msg = '<div>'.$str.'</div>';
        }
        return $msg;
    }
}
