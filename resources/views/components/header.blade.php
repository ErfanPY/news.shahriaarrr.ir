<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">News</a>
        <div class="navbar-nav">
            @auth
                <a class="nav-link" href="/dashboard">داشبورد</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link">خروج</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login.show') }}">ورود</a>
                <a class="nav-link" href="{{ route('register.show') }}">عضویت</a>
            @endauth
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">خانه</a>
                </li>
            </ul>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
