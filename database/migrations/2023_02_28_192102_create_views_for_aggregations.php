<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            create view per_user_over_time as 
            select 
                count(*) count,
                user_id,
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%d%m%Y') AS 'day_code',
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%H') AS 'hour_code'
            from 
                stream_events 
            where
                event_type = 'streamstart'
            group by 
                user_id,
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%d%m%Y'),
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%H')
            ;
        ");
        DB::statement("
            create view per_media_over_time as 
            select 
                count(*) count,
                media_id,
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%d%m%Y') AS 'day_code',
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%H') AS 'hour_code'
            from 
                stream_events 
            where
                event_type = 'streamstart'
            group by 
                media_id,
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%d%m%Y'),
                DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%H')
            ;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS per_user_over_time');
        DB::statement('DROP VIEW IF EXISTS per_media_over_time');
    }
};
