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
            $table->timestamp('boosted_until')->nullable()->after('superlikes_count');
            $table->timestamp('featured_until')->nullable()->after('boosted_until');
            $table->string('featured_plan')->nullable()->after('featured_until'); // 'semanal', 'mensal'
            $table->timestamp('see_likes_until')->nullable()->after('featured_plan');
            $table->boolean('is_premium')->default(false)->after('see_likes_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'boosted_until',
                'featured_until',
                'featured_plan',
                'see_likes_until',
                'is_premium'
            ]);
        });
    }
};
