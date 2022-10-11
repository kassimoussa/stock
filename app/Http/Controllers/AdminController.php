<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $service = session('service');
        $level = session('userLevel');
        $users = User::where('service', $service)->orderBy('name', 'asc')->get();

        return view($level.'.admin.listusers', compact('users'));

    }

    public function createuser()
    { 
        $level = session('userLevel'); 

        return view($level.'.admin.addUser');
    }

    public function storeuser(Request $request)
    {
        $service = session('service');
        $dir = session('dir');

        //validate the input
        $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:8|max:16', 
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = "1";
        $user->direction = $dir;
        $user->service = $service;
        $query = $user->save();

        if ($query) {
            return back()->with('success', 'Ajout réussi !!!');
        } else {
            return back()->with('fail', 'Echec de l\'ajout !!!');
        }
    }

    public function edituser(User $user)
    { 
        $level = session('userLevel'); 

        return view($level.'.admin.edituser', compact('user'));
    }
}
