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
    
      User::factory()->create([
        'name'=> 'User',
        'email'=> 'user@mail.com',
        'password'=> \bcrypt('12345678'),
      ]);
      
      Plan::factory()->create([
        'name'        => 'Monthly',
        'slug'        => 'monthly',
        'stripe_plan' => 'monthly',
        'cost'        => 30, 
        'description' => 'One month access to the entire library'
      ]);

      Plan::factory()->create([
        'name'        => 'Yearly',
        'slug'        => 'yearly',
        'stripe_plan' => 'yearly',
        'cost'        => 60, 
        'description' => 'One-year access to the entire library'
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
