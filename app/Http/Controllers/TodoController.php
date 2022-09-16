<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //タスク一覧表示
    public function index()
    {
        $todos = Todo::all();

        return view('todo.index', compact('todos'));
    }

    public function create()
    {
        return view('todo.create');
    }

    //タスク登録処理
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->save();
    
        return redirect('todos')->with('status', $todo->title . 'を登録しました!');
    }

    //詳細画面表示
    public function show($id)
    {  
    $todo = Todo::find($id);

    return view('todo.show', compact('todo'));
    }


    public function edit($id)
    {
        $todo = Todo::find($id);
    
        return view('todo.edit', compact('todo'));
    }

    //更新処理
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
    
        $todo->title = $request->input('title');
        $todo->save();
    
        return redirect('todos')->with('status', $todo->title . 'を更新しました!');
    }

    //削除処理
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
    
        return redirect('todos')->with('status',$todo->title . 'を削除しました!');
    }
}
