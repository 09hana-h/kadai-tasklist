<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    //getでtasks/にアクセスされた場合の一覧表示処理
    public function index()
    {
        //
    }

    //getでtasks/createにアクセスされた場合の新規登録画面表示
    public function create()
    {
        //
    }

    //postでtasks/にアクセスされた場合の新規登録処理
    public function store(Request $request)
    {
        //
    }

     // getでtasks/（任意のid）にアクセスされた場合の取得表示処理
    public function show($id)
    {
        //
    }

    //getでtasks/(任意のid)/editにアクセスされた場合の更新画面表示処理
    public function edit($id)
    {
        //
    }

    //putまたはpatchでtasks/(任意のid)にアクセスされた場合の更新処理
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
