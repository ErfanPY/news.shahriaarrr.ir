<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="max-age=3600">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>وبسایت وبلاگ</title>

    <!-- استایل سفارشی -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- آیکن‌ها -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- فونت گوگل (مونتسرات) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


</head>
<body>
    <div id="app">
       <nav>
        <div class="container nav__container">
            <a href="{{route('home')}}" class="nav__logo">وبسایت خبری</a>
            <ul class="nav__items">
                <li><a href="{{route('post')}}">وبلاگ</a></li>
                <li><a href="{{route('about')}}">درباره ما</a></li>

                @guest
                <li><a href="{{route('login')}}">ورود</a></li>
                <li><a href="{{route('register')}}">ثبت نام</a></li>
                @else
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="https://placehold.co/10x10">
                    </div>
                    <ul>
                        <li><a href="{{route('dashboard')}}">پنل ادمین</a></li>
                        <li><a href="{{route('logout')}}"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">خروج</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                    </ul>
                </li>
                @endguest

            </ul>

            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>


<footer>
    <div class="footer__socials">
        <a href="https://www.youtube.com/channel/UCvtrqmex9f7J9hxZfmhoHRw" target="_blank"><i class="uil uil-youtube"></i></a>
        <a href="https://www.instagram.com/_underemployed_/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
        <a href="https://www.linkedin.com/in/nithin-a-06b946256/" target="_blank"><i class="uil uil-linkedin"></i></a>
        <a href="" target="_blank"><i class="uil uil-facebook-f"></i></a>
    </div>
    <div class="container footer__container">
        <article>
            <h4>دسته‌بندی‌ها</h4>
            <ul>
                <li><a href="">موسیقی</a></li>
                <li><a href="">فیلم‌ها</a></li>
                <li><a href="">سفر</a></li>
                <li><a href="">علم و فناوری</a></li>
                <li><a href="">غذا</a></li>
            </ul>
        </article>
        <article>
            <h4>پشتیبانی</h4>
            <ul>
                <li><a href="">پشتیبانی آنلاین</a></li>
                <li><a href="">شماره‌های تماس</a></li>
                <li><a href="">ایمیل‌ها</a></li>
            </ul>
        </article>

        <article>
            <h4>لینک‌های دائمی</h4>
            <ul>
                <li><a href="">خانه</a></li>
                <li><a href="">وبلاگ</a></li>
                <li><a href="">درباره ما</a></li>
                <li><a href="">خدمات</a></li>
                <li><a href="">تماس</a></li>
            </ul>
        </article>
    </div>

</footer>

<script src="{{asset('js/main.js')}}"></script>
</body>
</html>
