<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Loden',
            'address' => 'CDMX',
            'email' => 'loden@loden.com',
            'phone_number' => '5598237840',
        ]);
    }
}
