<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Image;
use App\Models\Plan;

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
        'name'=> 'User',
        'email'=> 'user@mail.com',
        'password'=> \bcrypt('12345678'),
      ]);
      
      Plan::factory()->create([
        'name'        => 'Mensual',
        'slug'        => 'mensual',
        'stripe_plan' => 'mensual',
        'cost'        => 30, 
        'description' => 'Acceso por un mes a toda la biblioteca'
      ]);

      Plan::factory()->create([
        'name'        => 'Anual',
        'slug'        => 'anual',
        'stripe_plan' => 'anual',
        'cost'        => 60, 
        'description' => 'Acceso por un año a toda la biblioteca'
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
