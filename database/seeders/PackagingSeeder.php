<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Packaging;

class PackagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $packags=[
            ['packaging_name'=>'แผง'],
            ['packaging_name'=>'กล่อง'],
            ['packaging_name'=>'ถุง'],
           
        ];
        foreach ($packags as $key => $packag) {
            Packaging::create($packag);
        }
    }
}
