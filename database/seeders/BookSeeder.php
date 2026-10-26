<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'description' => 'Kisah perjuangan anak-anak Belitung.',
                'price' => 25000,
                'stock' => 10,
                'cover' => 'laskar-pelangi.jpg',
                'author_id' => 1,
            ],
            [
                'title' => 'Bumi',
                'description' => 'Novel petualangan dunia paralel.',
                'price' => 90000,
                'stock' => 15,
                'cover' => 'bumi.jpg',
                'author_id' => 2,
            ],
            [
                'title' => 'Filosofi Teras',
                'description' => 'Buku pengantar filsafat Stoisisme.',
                'price' => 75000,
                'stock' => 12,
                'cover' => 'filosofi-teras.jpg',
                'author_id' => 3,
            ],
            [
                'title' => 'Harry Potter',
                'description' => 'Kisah petualangan seorang penyihir muda.',
                'price' => 85000,
                'stock' => 8,
                'cover' => 'harry-potter.jpg',
                'author_id' => 4,
            ],
            [
                'title' => 'Koala Kumal',
                'description' => 'Kumpulan cerita tentang cinta dan kehidupan.',
                'price' => 65000,
                'stock' => 10,
                'cover' => 'koala-kumal.jpg',
                'author_id' => 5,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
