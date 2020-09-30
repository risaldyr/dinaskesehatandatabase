<?php

namespace App\Http\Controllers;
use App\User;
use App\User_Task;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showAllTask()
    {
        return response()->json(User_Task::all());
    }

    public function createTask($id, Request $request)
    {
        $user = User::find($id);

        $this->validate($request, [
            'task' => 'required'
        ]);

        $tasks = $request->input('task');
        $task = User_Task::create([
            'task' => $tasks,
            'user_id' => $user->id,
        ]);

        return response()->json($task, 201);
    }

    public function showTaskUser($id)
    {
        $user =User::find($id);

        $shows = $user->user_tasks()->get();

        foreach($shows as $show){
            $data[] = [
                'name' => $show->user->nama,
                'task' => $show->task,
                'task_id' => $show->id,
                'created_at' => $show->created_at
            ];
        }
        return response()->json($data);
    }

}
