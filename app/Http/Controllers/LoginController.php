<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller{

    //最初の画面
    public function index(Request $request){

        // 非ログイン時はアカウント登録フォーム、ログイン時はログアウトボタンを表示するといった切り替えのため session に保存された login_id を取得
        $loginId = $request->session()->get("login_id",null);
        $variables = [
            "isLoginActive" => isset($loginId)
        ];

        return view("login/index",["variables" => $variables]);
    }

    //アカウント登録処理
    public function register(Request $request){

        //formからの入力情報の取得
        $id = $request->input("id");
        $password = $request->input("password");

        $oldRecords = DB::connection('mysql')->select("select count(*) from users where id_str = '" . $id . "'");

        // sql query に失敗している場合、処理失敗として終了する。
        if(count($oldRecords) == 0){
            return response("処理中に問題が発生しました。<a href='/login'>前のページへ戻る</a>");
        }

        // count(*) の値が 0 より大きい場合は同一 id の record が存在することになるため、処理を終了する。
        $record = (array)($oldRecords[0]);
        if($record["count(*)"]>0){
            return response("すでに存在するアカウント id です。<a href='/login'>前のページへ戻る</a>");
        }

        // ここまで正常に処理が進んだら既存のレコードも存在しないため、入力情報をもとにレコードを追加する。
        DB::connection('mysql')->insert("insert into users (id_str,password) values ('" . $id . "','" . $password . "')");
        
        $records = DB::connection('mysql')->select("select * from users where id_str = '" . $id . "'");

        if(count($records) == 0){
            return response("ユーザーデータの登録処理中に問題が発生しました。<a href='/login'>前のページへ戻る</a>");
        }

        $request->session()->put("login_id",$records[0]->id);
        
        return response("登録が完了しました。<a href='/login'>前のページへ戻る</a>");
        
    }

    //ログイン処理
    public function sigin_in(Request $request)
    {
        //ログインフォームからの入力情報
        $id = $request->input("id");
        $password = $request->input("password");

        //入力したIDとパスワードのデータ行数を抽出
        $record_id = DB::connection('mysql')->select("select * from users where id_str = '" . $id . "'");
        $record_pw = DB::connection('mysql')->select("select * from users where password = '" . $password . "'");
        
        //dd($oldRecords);
        //var_dump((array)($oldRecords[0]));

        //idとpasswordが誤っていた時のエラー
        if (count($record_id) == 0 && count($record_pw) == 0) {
            return response("IDとPWが誤っているためログインできません。<a href='/login'>前のページへ戻る</a>");
        }

        //idが誤っていた時のエラー
        if (count($record_id) == 0) {
            return response("IDが誤っているためログインできません。<a href='/login'>前のページへ戻る</a>");
        }

        //passwordが誤っていた時のエラー
        if (count($record_pw) == 0) {
            return response("PWが誤っているためログインできません。<a href='/login'>前のページへ戻る</a>");
        }

        //ここまできたらログイン処理を行う
        $records = DB::connection('mysql')->select("select * from users where id_str = '" . $id . "'");
        $request->session()->put("login_id",$records[0]->id);
        return response("ログインに成功しました。<a href='/login'>前のページへ戻る</a>");
    }

    //ログアウト処理
    public function unregister(Request $request)
    {
        $request->session()->flush();
        return response("ログアウトが完了しました。<a href='/login'>前のページに戻る</a>");    
    }
}