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
        CREATE OR REPLACE VIEW active_subscriptions AS
        select
            s.id as subscription,
            ss.name,
            ss.price,
            u.id as user_id,
            u.username,
            h.id as house_id,
            h.title,
            s.subscription_start_date,
            s.subscription_end_date
        from users u
                 join subscriptions s on u.id = s.user_id
                 join houses h on h.id = s.house_id
        join services ss on ss.id = s.service_id
        where s.subscription_end_date is null
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS active_subscriptions');
    }
};


