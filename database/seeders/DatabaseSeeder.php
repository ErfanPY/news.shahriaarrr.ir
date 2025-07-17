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
        $body =  'متن تستی آزمایشی بسیار طولانی و زیاد برای تست و بررسی نحوه نمایش';

        User::factory()->create([
            'name' => 'مدیر سایت',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        for($i=0;$i<10;$i++){
            User::factory()->create([
            'name' => 'کاربر '.$i,
            'email' => $i.'user@example.com',
            'password' => Hash::make('12345678'),
        ]);
        }

        for($i=0;$i<5;$i++){
            Category::create(['name' => 'دسته بندی'.$i]);
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
