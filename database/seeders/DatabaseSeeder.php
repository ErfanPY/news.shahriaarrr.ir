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

        // Create 5 Persian news categories
        $categories = [
            'اخبار سیاسی',
            'اخبار اقتصادی', 
            'اخبار ورزشی',
            'اخبار فناوری',
            'اخبار فرهنگی'
        ];
        
        foreach($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }

        $imagePath = 'form-attachments/cat-image.jpg';
        $fullPath = public_path($imagePath);
        
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }
        
        // Persian cat-related news titles
        $catNewsTitles = [
            'گربه‌ای که از آتش‌سوزی جان سالم به در برد',
            'رکورد جدید گربه در پرش ارتفاع',
            'گربه درمانگر در بیمارستان کودکان',
            'کشف گونه جدید گربه در جنگل‌های شمال',
            'گربه‌ای که صاحبش را از سقوط نجات داد',
            'راه‌اندازی پناهگاه جدید برای گربه‌های بی‌خانمان',
            'گربه‌ای که ۲۰ سال عمر کرد',
            'گربه‌های معروف اینستاگرام',
            'گربه‌ای که پیانو می‌نوازد',
            'راهنمای نگهداری از گربه برای مبتدیان'
        ];
        
        for($i=0;$i<10;$i++){
            $uniqueImagePath = 'form-attachments/cat-image-' . $i . '.jpg';
            $uniqueFullPath = public_path($uniqueImagePath);
            
            if (!file_exists($uniqueFullPath)) {
                file_put_contents($uniqueFullPath, file_get_contents('https://www.placekittens.com/400/400'));
            }
            
            Post::create([
                'name' => $catNewsTitles[$i],
                'body' => $body,
                'category_id' => rand(1,5),
                'user_id' => rand(1,5),
                'status' => 'done',
                'url' => $uniqueImagePath
            ]);
        }


    }
}
