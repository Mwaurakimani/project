<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE VIEW event_resolution AS
             select
                u.id as user_id,
                u.username,
                i.id as invite_id,
                e.id as event_id,
                i.status,
                e.event_start_date
            from users u
            join invites i on u.id = i.tenant_id
            join events e on i.event_id = e.id
            where status Like \'Accepted\'
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS event_resolution');
    }
};
