<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleController extends Controller {
    public function index( Request $request ) {

        //追加
        //$insertResult = DB::connection('mysql')->insert("insert into users (email,name,password) value('tanaka@gmail.com','田中','tanaka'),('suzuki@gmail.com','鈴木','suzuki'),('satou@gmail.com','佐藤','satou')");   

        //削除
        $deleteResult = DB::connection('mysql')->delete("delete from users where id = 3");

        return view("sample/index" , []);
    }
}