<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Buku 1',
            'author' => 'Author 1',
            'total_books' => 100,
            'total_borrow' => 0,
            'total_book_available' => 100,
            'fk_category' => 1,
        ]);

        Book::create([
            'title' => 'Buku 2',
            'author' => 'Author 2',
            'total_books' => 100,
            'total_borrow' => 0,
            'total_book_available' => 100,
            'fk_category' => 2,
        ]);
    }
}