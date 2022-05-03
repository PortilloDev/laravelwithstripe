<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Image;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Storage::deleteDirectory('books');
      Storage::makeDirectory('books');

      User::factory()->create([
        'name'=> 'Ivan',
        'email'=> 'i@mail.com',
        'password'=> \bcrypt('12345678'),
      ]);
      
      $books = Book::factory(10)->create();

      foreach ($books as $book) {
        Image::factory(1)->create([
            'imageable_id' => $book->id,
            'imageable_type' =>'App\Models\Book',
        ]);
      }
    }
}
