<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS master');

        $tableExists = DB::select("SELECT 1 FROM information_schema.tables WHERE table_schema = 'master' AND table_name = 'users'");

        if (empty($tableExists)) {
            DB::statement('ALTER TABLE public.users SET SCHEMA master');
        }

        DB::statement('CREATE SCHEMA IF NOT EXISTS transactions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE master.users SET SCHEMA public');
        DB::statement('DROP SCHEMA IF EXISTS master CASCADE');
        DB::statement('DROP SCHEMA IF EXISTS transactions CASCADE');
    }
};
