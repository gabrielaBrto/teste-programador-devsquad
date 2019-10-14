<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'nome'          => 'Móveis',
            ],
            [
                'nome'          => 'Eletrodomésticos',
            ],
            [
                'nome'          => 'Informática',
            ],
            [
                'nome'          => 'Games',
            ],
            [
                'nome'          => 'Ferramentas',
            ],
            
        ]);
    }
}
