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
        // Step 1: Update existing data to be valid JSON
        DB::table('packages')->get()->each(function ($branch) {
            DB::table('packages')
                ->where('id', $branch->id)
                ->update([
                    'name' => json_encode(['ar' => $branch->name, 'en' => '']),
                    // 'description' => $branch->description
                    //     ? json_encode(['ar' => $branch->description, 'en' => ''])
                    //     : null,
                ]);
        });

        // Step 2: Alter columns to JSON type
        Schema::table('packages', function (Blueprint $table) {
            $table->json('name')->change();
            // $table->json('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->text('name')->change();
            // $table->text('description')->nullable()->change();
        });
    }
};
