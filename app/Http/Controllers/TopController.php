<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopController extends Controller {

    //ルートから指示があったときに実行
    public function index( Request $request ) {

        $phpValue = "ひとよひとよにひとみごろ";

        //データベース操作
        //$records = DB::connection('mysql')->select("select * from items");
        //$name = $records[0]->name;

        //データ追加
        //$insertResult = DB::connection('mysql')->insert("insert into items (id,name,price) value(null,'メロン',2000)");
        
        //更新
        //$updateResult = DB::connection('mysql')->update("update items set price = 600 where name = '商品1'");
        
        //削除
        //$deleteResult = DB::connection('mysql')->delete("delete from items where name = '商品1'");
        //dd($deleteResult);

        return view("top/index" , ["phpValue" => $phpValue]);
    }
}
