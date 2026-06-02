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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('number', 5);
            $table->string('ticket', 10)->nullable();
            $table->string('client', 100)->nullable();
            $table->foreignId('system_id')->constrained('systems');
            $table->string('title', 100);
            $table->string('version', 10);
            $table->text('description')->nullable();
            $table->text('preconditions')->nullable();
            $table->text('steps')->nullable();
            $table->text('expected_result')->nullable();
            $table->text('actual_result')->nullable();
            $table->text('observations')->nullable();
            $table->foreignId('tester_id')->constrained('users');
            $table->foreignId('developer_id')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('type_id')->constrained('types');
            $table->foreignId('status_id')->constrained('statuses');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
