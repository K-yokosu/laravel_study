<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{

    public function showTasks(){
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->get();
        // dd($user_id);

        return view('task', compact('tasks'));
    }

    public function taskRegister(Request $request){
        $user_id = Auth::id();
        $task = Task::query()->create([
            'user_id' => $user_id,
            'content' => $request['content'],
        ]);

        return redirect()->route(route: 'profile');
    }
}
