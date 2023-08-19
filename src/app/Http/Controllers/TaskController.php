<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function showTasks(){
        return view(view: 'task');
    }

    public function taskRegister(Request $request){
        $task = Task::query()->create([
            'user_id' => $id = Auth::id(),
            'content' => $request['content'],
        ]);

        return redirect()->route(route: 'profile');
    }
}
