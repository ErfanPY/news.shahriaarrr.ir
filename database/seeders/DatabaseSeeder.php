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
            'email' => $i.'user@example.com',
            'password' => Hash::make('12345678'),
        ]);
        }

        for($i=0;$i<5;$i++){
            Category::create(['name' => 'cat'.$i]);
        }

        $imagePath = 'form-attachments/cat-image.jpg';
        $fullPath = public_path($imagePath);
        
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }
        
        for($i=0;$i<10;$i++){
            $uniqueImagePath = 'form-attachments/cat-image-' . $i . '.jpg';
            $uniqueFullPath = public_path($uniqueImagePath);
            
            echo "Downloading cat image for post " . ($i + 1) . "...\n";
            file_put_contents($uniqueFullPath, file_get_contents('https://www.placekittens.com/400/400'));
            
            echo "Creating post " . ($i + 1) . " with image: " . $uniqueImagePath . "\n";
            Post::create([
                'name' => 'name',
                'body' => $body,
                'category_id' => rand(1,5),
                'user_id' => rand(1,5),
                'status' => 'done',
                'url' => $uniqueImagePath
            ]);
        }


    }
}
