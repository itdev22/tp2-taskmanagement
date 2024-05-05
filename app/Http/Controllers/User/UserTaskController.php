<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function list(Request $request)
    {
        // return $request;
        $task = Task::query();
        $countTotal = $task->where('user_id',Auth::user()->id)->count();

        $task = $task->with('user');
        if($request->search['value']){
            $task = $task->where('name','like',"%".$request->search['value']."%")->orWhere('description','like',"%".$request->search['value']."%");
        }
        $task = $task->where('user_id',Auth::user()->id)->limit($request->length);
        $countFilter = $task->count();
        $dataTask = $task->get();

        $result = [
            "draw" => $request->draw,
            "recordsTotal" => $countTotal,
            "recordsFiltered" => $countFilter,
            "data" => $dataTask
        ];
        return $result;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $user = Auth::user();
        if(!$user){
            return redirect()->back()->with(['error'=>'Email User Not found!']);
        }

        // dd($user->id);
        Task::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=>$user->id,
        ]);

        return redirect()->back()->with(['success'=>'Task was Created!']);
    }


    public function edit(Request $request, Task $task)
    {
        $task = Task::find($task->id);
        return view('user.task.edit',compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $task->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);

        return redirect()->back()->with(['success'=>'Task was Updated!']);
    }
}
