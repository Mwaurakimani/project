<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $path = './database/seeders/SeederFiles';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seed_users();
    }

    public function seed_users()
    {

        $file = file_get_contents($this->path . "/users.json");
        $data = json_decode($file);
        $users = $data->data;


        foreach ($users as $key => $user_properties) {
            $user_model = new User();

            foreach ($user_properties as $key => $value) {
                if ($key == 'password') {
                    $user_model->{$key} = bcrypt($value);
                    continue;
                }
                $user_model->{$key} = $value;
            }

            $user_model->save();
        }
    }
}
