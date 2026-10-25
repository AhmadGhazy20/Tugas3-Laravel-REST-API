<?php

namespace App\Models;

class Genre
{
    private array $genres = [
        ['id' => 1, 'name' => 'Fantasy'],
        ['id' => 2, 'name' => 'Romance'],
        ['id' => 3, 'name' => 'Horror'],
        ['id' => 4, 'name' => 'Mystery'],
        ['id' => 5, 'name' => 'Science Fiction'],
    ];

    public function getGenres(): array
    {
        return $this->genres;
    }
}
