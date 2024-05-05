<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function list(Request $request)
    {
        // return $request;
        $user = User::query();
        $countTotal = $user->count();

        $user = $user->where('name','like',"%".$request->search['value']."%")->orWhere('email','like',"%".$request->search['value']."%")->limit($request->length);
        $countFilter = $user->count();
        $dataUser = $user->get();

        $result = [
            "draw" => $request->draw,
            "recordsTotal" => $countTotal,
            "recordsFiltered" => $countFilter,
            "data" => $dataUser
        ];
        return $result;
    }

    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $request['password'] = Hash::make($request['password']);
        $request['name'] = $request['username'];

        if (User::where('email', $request->email)->first()) {
            return redirect()->back()->with(['error' => 'Email already exists']);
        }

        User::create($request->all());

        return redirect()->back()->with(['success' => 'User created successfully']);
    }
}
