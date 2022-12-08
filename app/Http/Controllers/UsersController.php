<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return Inertia::render('AppPages/Users/index',[
            'users' => $users
        ]);
    }

    public function getUsers(User $id)
    {
        $user = $id;
        return $user;
    }

    public function updateUsers(User $user)
    {
        dd($user);
    }

    public function createUser(Request $request)
    {
        $user = new User();

        $user->first_name = $request['firstName'];
        $user->last_name = $request['lastName'];
        $user->email = $request['email'];
        $user->password = bcrypt("password");
        $user->designation = $request['designation'];
        $user->department_id = $request['department'];
        $user->account_type = $request['accountType'];

        try {
            $user->save();
            Session::flash('message','User created successfully');
        }catch (\Exception $e){
            Session::flash('message','Error creating User');
        }
        return redirect()->route('ListUsers');
    }
}
