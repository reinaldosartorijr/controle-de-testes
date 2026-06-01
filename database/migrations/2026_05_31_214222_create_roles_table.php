<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the roles table.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('active');
            $table->timestamps();
        });

        /**
         * Creating basic roles
         */
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
                'description' => 'Responsável pela equipe de desenvolvimento.',
                'active' => true
            ],
            [
                'name' => 'Analista',
                'description' => 'Analista de Sistemas. Responsável pela análise de requisitos do item',
                'active' => true
            ],
            [
                'name' => 'Programador',
                'description' => 'Programador responsável pela implementação do item',
                'active' => true
            ],
            [
                'name' => 'Testador',
                'description' => 'Responsável pelo Teste do Produto',
                'active' => true
            ],
        ]);
    }

    /**
     * Reverse the migrations to drop the roles table.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
