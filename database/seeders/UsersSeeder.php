<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        if (User::count() < 1) {
            User::factory()->count(10)->create();
        }

        $super_admin = User::first();

        $super_admin->assignRole('Super admin');

        User::whereNotIn('id', [$super_admin->id])
            ->each(fn(User $user) => $user->assignRole('Editor'));
    }
}
