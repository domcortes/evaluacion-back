<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['title' => 'Categoria 1'],
            ['title' => 'Categoria 2'],
            ['title' => 'Categoria 3'],
            ['title' => 'Categoria 4'],
            ['title' => 'Categoria 5'],
            ['title' => 'Categoria 6'],
            ['title' => 'Categoria 7'],
            ['title' => 'Categoria 8'],
            ['title' => 'Categoria 9'],
            ['title' => 'Categoria 10'],
            ['title' => 'Categoria 11'],
            ['title' => 'Categoria 12'],
        ]);
    }
}
