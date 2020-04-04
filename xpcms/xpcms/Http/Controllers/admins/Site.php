<?php
namespace xpcms\Http\Controllers\admins;
use Illuminate\Http\Request;
use xpcms\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Site extends Controller
{
    public function index(){
        return view('admin.site.index');
    }
}
