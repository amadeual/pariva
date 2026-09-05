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
            $table->boolean('is_verified')->default(false)->after('interested_in');
            $table->string('verification_badge')->nullable()->after('is_verified'); // e.g., 'Oficial', 'Profissional', 'VIP'
            $table->integer('roses_count')->default(5)->after('verification_badge');
            $table->integer('superlikes_count')->default(3)->after('roses_count');
        });

        Schema::create('user_gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->string('gift_type')->default('rose'); // 'rose', 'superlike'
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_gifts');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_verified', 'verification_badge', 'roses_count', 'superlikes_count']);
        });
    }
};
