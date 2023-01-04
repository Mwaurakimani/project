<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE VIEW active_tenants AS
        select
            r.id as rent_id,
            u.id as user_id,
            u.username,
            h.id as house_id,
            h.title,
            r.start_date,
            h.rent_amount
        from users u
        join rents r on u.id = r.user_id
        join houses h on r.house_id = h.id
        where end_date is null
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS active_tenants');
    }
};
