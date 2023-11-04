<?php

namespace Database\Seeders;

use App\Models\Keyword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keywords = ['laravel','php', 'html' , 'css' , 'bootstrap'];
        foreach($keywords as $keyword){
            Keyword::create([
                'name' => $keyword,
            ]);
        }
    }
}
