<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    //getでtasks/にアクセスされた場合の一覧表示処理
    public function index()
    {
        $data = [];
        if (\Auth::check()) { //認証済みの場合
            //認証済みのユーザを取得
            $user = \Auth::user();
            //ユーザの投稿一覧を日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
        return view('welcome', $data);
            
    }


    //getでtasks/createにアクセスされた場合の新規登録画面表示
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
            'task' => $task,
        ]);
        
    }

    //postでtasks/にアクセスされた場合の新規登録処理
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = $request->user()->id;
        $task->save();
        
        return redirect('/');
    }

     // getでtasks/（任意のid）にアクセスされた場合の取得表示処理
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
        else{
            return redirect('/');
        }
    }

    //getでtasks/(任意のid)/editにアクセスされた場合の更新画面表示処理
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        else{
            return redirect('/');
        }
    }

    //putまたはpatchでtasks/(任意のid)にアクセスされた場合の更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = $request->user()->id;
        $task->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        return redirect('/');
    }
}