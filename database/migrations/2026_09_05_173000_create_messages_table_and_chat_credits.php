<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('direct_chat_credits')->default(0)->after('is_premium');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('direct_chat_credits');
        });
    }
};
