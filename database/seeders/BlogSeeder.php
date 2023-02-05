<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('blogs')->insert([
          'title' => 'First blog',
          'sub_header' => 'This is the first sub header',
          'content' => 'BLOG_CONTENT',
          'created_at'=> now()
      ]);
    }
}
