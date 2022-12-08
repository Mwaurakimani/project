<?php

namespace App\Logic\Classes;

class Event
{
    public function create(): bool
    {
        $event = new \App\Models\Event();

        $event->first_name = "test";
        $event->last_name = "test";
        $event->email = "test";
        $event->designation = "test";
        $event->department_id = "test";
        $event->account_type = "test";
        $event->password = "test";

        return ($event->save());
    }

    //add retrieval policies
    public function read($id)
    {
        $event = \App\Models\Event::find($id);
        return $event;
    }

    public function update(\App\Models\Event $user_model,$user_data): bool
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

    public function delete(\App\Models\Event $user_model): ?bool
    {
        return $user_model->delete();
    }

    //add retrieval policies
    public function readAll(): \Illuminate\Database\Eloquent\Collection
    {
        $events = \App\Models\Event::all();

        return $events;
    }

    public function filter(): bool
    {
        return False;
    }
}
