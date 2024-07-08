<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Post::create([
                'user_id' =>1 ,
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'is_flagged' => 0,
                'is_approved' => 0,
            ]);
        }
    }
}
