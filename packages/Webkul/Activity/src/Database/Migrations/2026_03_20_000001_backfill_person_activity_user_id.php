<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('activities')
            ->join('person_activities', 'activities.id', '=', 'person_activities.activity_id')
            ->join('persons', 'person_activities.person_id', '=', 'persons.id')
            ->where('activities.type', 'system')
            ->whereNull('activities.user_id')
            ->whereNotNull('persons.user_id')
            ->update([
                'activities.user_id' => DB::raw('persons.user_id'),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Irreversible data backfill.
    }
};
