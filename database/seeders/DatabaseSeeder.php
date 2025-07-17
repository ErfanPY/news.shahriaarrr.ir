<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $body =  'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab, officiis quae. Saepe sed illo non beatae pariatur quod similique, ea, molestiae amet enim illum omnis mollitia eos quo, dolores fuga!';
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        for($i=0;$i<10;$i++){
            User::factory()->create([
            'name' => 'Test User'.$i,
            'email' => $i.'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
        }

        for($i=0;$i<10;$i++){
            Category::create(['name' => 'cat'.$i]);
        }
        for($i=0;$i<30;$i++){
            Post::create([
                'name' => 'name',
                'body' => $body,
                'category_id' => rand(1,5),
                'user_id' => rand(1,5),
                'status' => 'done',
                'url' => 'form-attachments/custom-prefix-20220829_192922.jpg
'
            ]);
        }


    }
}
