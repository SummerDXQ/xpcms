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
    }
}
