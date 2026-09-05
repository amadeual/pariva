<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLike;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $demoUser = User::create([
            'name' => 'Isabella Oliveira',
            'email' => 'isabella@pariva.com',
            'password' => Hash::make('12345678'),
        ]);

        $mariana = User::create([
            'name' => 'Mariana Silva',
            'email' => 'mariana@pariva.com',
            'password' => Hash::make('12345678'),
        ]);

        $sofia = User::create([
            'name' => 'Sofia Santos',
            'email' => 'sofia@pariva.com',
            'password' => Hash::make('12345678'),
        ]);

        $rafael = User::create([
            'name' => 'Rafael Costa',
            'email' => 'rafael@pariva.com',
            'password' => Hash::make('12345678'),
        ]);

        // Seed some likes to Isabella so /curtidas shows real likes in DB
        UserLike::create([
            'user_id' => $mariana->id,
            'liked_user_id' => $demoUser->id,
            'is_superlike' => false,
        ]);

        UserLike::create([
            'user_id' => $sofia->id,
            'liked_user_id' => $demoUser->id,
            'is_superlike' => true,
        ]);

        UserLike::create([
            'user_id' => $rafael->id,
            'liked_user_id' => $demoUser->id,
            'is_superlike' => false,
        ]);
    }
}
