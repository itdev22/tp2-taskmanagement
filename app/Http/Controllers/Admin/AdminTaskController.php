<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

class AdminTaskController extends Controller
{
    public function list(Request $request)
    {
        // return $request;
        $task = task::query();
        $countTotal = $task->count();

        $task = $task->with('user')->where('name','like',"%".$request->search['value']."%")->orWhere('description','like',"%".$request->search['value']."%")->limit($request->length);
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
            'email' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
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
}
