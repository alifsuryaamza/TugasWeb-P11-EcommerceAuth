<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $editor = User::where('email', 'editor@example.com')->first();
        $admin = User::where('email', 'admin@example.com')->first();

        $titles = [
            'Tips Memilih Headphone untuk Kerja',
            'Panduan Merawat Sepatu Kanvas',
            'Cara Menyimpan Kopi Agar Tetap Segar',
            'Rekomendasi Perlengkapan Olahraga di Rumah',
            'Mengenal Kandungan Sunscreen',
            'Checklist Belanja Bulanan Hemat',
        ];

        foreach ($titles as $i => $title) {
            Post::create([
                'user_id' => $i % 2 === 0 ? $editor->id : $admin->id,
                'title' => $title,
                'body' => fake()->paragraphs(3, true),
            ]);
        }
    }
}