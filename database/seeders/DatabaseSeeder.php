<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Author::factory(10)->hasBooks(5)->create();
    }
}

