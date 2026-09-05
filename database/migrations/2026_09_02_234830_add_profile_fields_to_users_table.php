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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable()->default(28);
            $table->string('location')->nullable()->default('São Paulo, SP');
            $table->string('profession')->nullable()->default('Designer & Fotógrafa');
            $table->text('bio')->nullable()->default('Adoro viajar, descobrir restaurantes novos e passar o domingo no parque.');
            $table->json('interests')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['age', 'location', 'profession', 'bio', 'interests']);
        });
    }
};
