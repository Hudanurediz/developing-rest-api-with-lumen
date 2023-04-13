<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required','min:8'],
        ]);
        $user= new User();
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }
    public function show($id)
    {
        $user= User::find($id);
        return response()->json($user);
    }
    public function update($id,Request $request)
    {
        $user= User::find($id);
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json($user);

    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('User deleted');
    }
}
