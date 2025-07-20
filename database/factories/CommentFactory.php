<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        $persianComments = [
            'مقاله بسیار مفیدی بود، ممنون از زحمات شما',
            'به نظرم این مطلب نیاز به ویرایش دارد',
            'عالی بود! دقیقا همان چیزی بود که دنبالش بودم',
            'بعضی قسمت‌ها نیاز به توضیح بیشتری دارد',
            'با برخی از نظرات مطرح شده موافق نیستم',
            'این موضوع را می‌توان از جنبه دیگری هم بررسی کرد',
            'ممنون از اشتراک گذاری این محتوای ارزشمند',
            'به نظر من این تحلیل کامل نیست',
            'لطفا منابع خود را هم ذکر کنید',
            'ایده جالبی بود، می‌شود بیشتر در موردش صحبت کرد'
        ];

        return [
            'content' => $this->faker->randomElement($persianComments),
            'user_id' => $this->faker->randomElement([User::factory(), 1, 2, 3, 32]),
            'post_id' => $this->faker->randomElement([Post::factory(), 1,2,3,4,5, 11]),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}