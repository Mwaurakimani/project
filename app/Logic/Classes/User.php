<?php

namespace App\Logic\Classes;

class User
{
    public function create(): bool
    {
        $user = new \App\Models\User();

        $user->first_name = "test";
        $user->last_name = "test";
        $user->email = "test";
        $user->designation = "test";
        $user->department_id = "test";
        $user->account_type = "test";
        $user->password = "test";

        return ($user->save());
    }

    //add retrieval policies
    public function read($id)
    {
        $user = \App\Models\User::find($id);
        return $user;
    }

    public function update(\App\Models\User $user_model,$user_data): bool
    {
        $content_length = count($user_data);

        if ($content_length > 0){
            foreach ($user_data as $key => $value){
                $user_model[$key] = $value;
            }

            return ($user_model->save());
        }else{
            return False;
        }
    }

    public function delete(\App\Models\User $user_model): ?bool
    {
        return $user_model->delete();
    }

    //add retrieval policies
    public function readAll(): \Illuminate\Database\Eloquent\Collection
    {
        $users = \App\Models\User::all();

        return $users;
    }

    public function filter(): bool
    {
        return False;
    }
}
