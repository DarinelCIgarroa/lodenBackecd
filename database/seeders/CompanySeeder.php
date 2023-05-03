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
            'city' => 'Ciudad de méxico',
            'state' => 'Ciudad de méxico',
            'zip_code' => '9312',
            'country' => 'México',
            'address' => 'CDMX',
            'phone_number' => '55982 37840',
            'email' => 'loden@loden.com',
        ]);
    }
}
