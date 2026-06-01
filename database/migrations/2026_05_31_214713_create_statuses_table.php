<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the statuses table.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('active');
            $table->timestamps();
        });

        /**
         * Creating basic statuses
         */
        DB::table('statuses')->insert([
            [
                'name' => 'Pendente',
                'description' => 'Não iniciado o teste do item',
                'active' => true
            ],
            [
                'name' => 'Em Teste',
                'description' => 'Item com teste em andamento',
                'active' => true
            ],
            [
                'name' => 'Falhou',
                'description' => 'Item com teste falhando. Aguardando correção',
                'active' => true
            ],
            [
                'name' => 'Passou',
                'description' => 'Item com teste aprovado.',
                'active' => true
            ]
        ]);
    }

    /**
     * Reverse the migrations to drop the status table.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
