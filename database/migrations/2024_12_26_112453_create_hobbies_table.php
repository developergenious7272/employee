<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

            DB::table('hobbies')->insert([
                [
                    'name' => 'Reading',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Writing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Cycling',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Swimming',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hobbies');
    }
};
