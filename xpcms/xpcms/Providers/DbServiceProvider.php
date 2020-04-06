<?php

namespace xpcms\Providers;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\ServiceProvider;

class DbServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
//    public function register()
//    {
//        //
//    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //customized first() function
        QueryBuilder::macro('item',function (){
            $res = $this->first();
            return $res? (array)$res : false;
        });

        //customized get()->all() function
        QueryBuilder::macro('lists',function (){
            $res = $this->get()->all();
            $lists=[];
            foreach ($res as $key=>$value){
                $lists[$key] = (array)$value;
            }
            return $lists;
        });

        QueryBuilder::macro('myFunc',function ($index){
            //DB::table('xpcms_admin_group')->myFunc('gid');
            //$this == DB::table('xpcms_admin_group')
            $res = $this->lists();
            $result = [];
            foreach ($res as $key=>$value){
                $result[$value[$index]] = (array)$value;
            }
            return $result;
        });

        //pagination
        QueryBuilder::macro('pages',function ($pageSize=10){
            $pageObj = $this->paginate($pageSize);
            $item_list = $pageObj->items();
            $result=[];
            foreach ($item_list as $key=>$value){
                $result[]=(array)$value;
            }
            //total lists
            $data['lists'] = $result;
            //total pages
            $data['total'] = $pageObj->total();
            //html page number
            $data["links"] = $pageObj->links();
            return $data;
        });
    }
}
