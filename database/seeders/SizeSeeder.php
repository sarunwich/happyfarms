<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sizes=[
            ['size_name'=>'เบอร์ 1'],
            ['size_name'=>'เบอร์ 2'],
            ['size_name'=>'เบอร์ 3'],
            ['size_name'=>'เบอร์ 4'],
            ['size_name'=>'เบอร์ 5'],
            ['size_name'=>'เบอร์ 6'],
            ['size_name'=>'50-59 กรัม'],
            ['size_name'=>'60-69 กรัม'],
            ['size_name'=>'70 กรัม ขึ้นไป'],
           
        ];
        foreach ($sizes as $key => $size) {
            size::create($size);
        }
    }
}
