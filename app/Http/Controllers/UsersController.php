<?php

namespace App\Http\Controllers;

use App\Logic\Classes\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use JetBrains\PhpStorm\NoReturn;

class UsersController extends Controller
{
    public function index()
    {
        $model = new User();
        $status = Template::readAll_models($model);

        dd($status);
    }

    public function create()
    {
        dd("create View");
    }

    public function store($data)
    {
        $model = new User();
        $model = Template::create_model($model,$data);
    }

    public function show($id)
    {
        $model = new User();
        $status = Template::read_model($model,'first_name',$id);
        dd($status);
    }

    public function edit()
    {
        $model = new User();
        $status = Template::create_model($model, [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test',
            'designation' => 'test',
            'department_id' => 'test',
            'account_type' => 'test',
            'password' => 'test',
        ]);

        dd($status);
    }

    public function update()
    {
        $model = new User();
        $status = Template::create_model($model, [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test',
            'designation' => 'test',
            'department_id' => 'test',
            'account_type' => 'test',
            'password' => 'test',
        ]);

        dd($status);
    }

    public function destror()
    {
        $model = new User();
        $status = Template::create_model($model, [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test',
            'designation' => 'test',
            'department_id' => 'test',
            'account_type' => 'test',
            'password' => 'test',
        ]);

        dd($status);
    }

    public function listUsers()
    {
        $users = User::all();
        return Inertia::render('AppPages/Users/index', [
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
            Session::flash('message', 'User created successfully');
        } catch (\Exception $e) {
            Session::flash('message', 'Error creating User');
        }
        return redirect()->route('ListUsers');
    }
}
