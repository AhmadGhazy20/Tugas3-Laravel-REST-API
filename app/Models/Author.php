<?php

namespace App\Models;

class Author
{
    private array $authors = [
        ['id' => 1, 'name' => 'Andrea Hirata'],
        ['id' => 2, 'name' => 'Tere Liye'],
        ['id' => 3, 'name' => 'Dee Lestari'],
        ['id' => 4, 'name' => 'Raditya Dika'],
        ['id' => 5, 'name' => 'Habiburrahman El Shirazy'],
    ];

    public function getAuthors(): array
    {
        return $this->authors;
    }
}
