<?php

namespace App\Logic\Classes;

use BaconQrCode\Common\Mode;
use Illuminate\Database\Eloquent\Model;

class Template
{
    public static function create_model(Model $MODEL, array $CONTENT,$PROPS = null): Model
    {
        $content_length = count($CONTENT);

        if ($content_length > 0) {
            foreach ($CONTENT as $key => $value) {
                $MODEL[$key] = $value;
            }
            $MODEL->save();
        }
        return $MODEL;
    }

    public static function read_model(Model $MODEL,$field_name,$value)
    {
        $RECORD = $MODEL->where($field_name,'=',$value)->get();
        return $RECORD;
    }

    public static function update_model(Model $MODEL, $CONTENT): Model
    {
        $content_length = count($CONTENT);

        if ($content_length > 0) {
            foreach ($CONTENT as $key => $value) {
                $CONTENT[$key] = $value;
            }
            $MODEL->save();
        }
        return $MODEL;
    }

    public static function delete_model(Model $MODEL): ?bool
    {
        return $MODEL->delete();
    }

    public static function readAll_models(Model $MODEL): \Illuminate\Database\Eloquent\Collection
    {
        return $MODEL::all();
    }

    public function filter_model(): bool
    {
        return False;
    }
}
