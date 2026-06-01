<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the types table.
     */
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('active');
            $table->timestamps();
        });

        /**
         * Creating basic types 
         */
        DB::table('types')->insert([
            [
                'name' => 'Customização', 
                'description' => 'Solicitação de customização de um cliente',
                'active' => true
            ],
            [
                'name' => 'Melhoria', 
                'description' => 'Melhoria implementada no sistema de solicitação interna da empresa',
                'active' => true
            ],
            [
                'name' => 'Fix', 
                'description' => 'Corrreção de um erro no sistema',
                'active' => true
            ]
        ]);
    }

    /**
     * Reverse the migrations to drop the types table.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
