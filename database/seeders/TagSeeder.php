<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::insert([
            ['nama' => 'Urgent', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Santai', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penting', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
