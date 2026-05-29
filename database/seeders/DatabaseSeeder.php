<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Cadu Prado',
            'email' => 'cadu.devmarketing@gmail.com',
            'phone' => '5511965878725',
            'password' => bcrypt("1234")
        ]);

        $this->call([
            PortfolioItemSeeder::class
        ]);
    }
}
