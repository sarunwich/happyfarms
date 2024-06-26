<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types=[
            ['type_name'=>'ไข่ไก่',
            'classifier'=>'แผง'
            ]
           
        ];
        foreach ($types as $key => $type) {
            Type::create($type);
        }
    }
}
