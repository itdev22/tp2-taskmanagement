<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class UserTaskController extends Controller
{
    public function list(Request $request)
    {
        // return $request;
        $task = Task::query();
        $countTotal = $task->where('user_id',Auth::user()->id)->count();

        $task = $task->with('user');
        if($request->search['value']){
            $task = $task->where('name','like',"%".$request->search['value']."%")->orWhere('description','like',"%".$request->search['value']."%")->orWhere('due_date',"%".$request->search['value']."%");
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

    public function grafik(Request $request)
    {
        // return $request;
        $data =[];
        $taskTODO = Task::where('user_id',Auth::user()->id)->where('status','TODO')->count();
        $taskPROGRESS = Task::where('user_id',Auth::user()->id)->where('status','ON PROGRESS')->count();
        $taskDONE = Task::where('user_id',Auth::user()->id)->where('status','FINISHED')->count();

        $data = [
            'TODO' => $taskTODO,
            'PROGRESS' => $taskPROGRESS,
            'DONE' => $taskDONE,
        ];
        return $data;
    }

    public function notification(Request $request)
    {
        // return $request;
        $task = Task::query();
        $countTotal = $task->where('user_id',Auth::user()->id)->where('status','TODO')->orWhere('due_date','<=',Date::now())->count();

        $task = $task->with('user');
        if($request->search['value']){
            $task = $task->where('name','like',"%".$request->search['value']."%")->orWhere('due_date','like',"%".$request->search['value']."%");
        }
        $task = $task->where('status','TODO')->orWhere('due_date','<=',Date::now())->where('user_id',Auth::user()->id)->limit($request->length);
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
            'date' => 'required',
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
            'due_date'=>$request->date,
        ]);

        return redirect()->back()->with(['success'=>'Task was Created!']);
    }


    public function edit(Request $request, Task $task)
    {
        $task = Task::find($request->id);
        // dd($task->name);
        return view('user.task.form',compact('task'));
    }
    public function destroy(Request $request, Task $task)
    {
        $task = Task::find($request->id);
        // dd($task->name);
        $task->delete();
        return redirect()->back()->with(['success'=>'Task was Deleted!']);

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $task = Task::find($request->id);
        $task->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);

        return redirect()->back()->with(['success'=>'Task was Updated!']);
    }
}
