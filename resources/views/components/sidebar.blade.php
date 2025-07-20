<div class="sidebar d-flex flex-column flex-shrink-0 bg-dark text-white p-3" style="width: 280px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">News</span>
    </a>
    
    <hr>
    
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/dashboard" class="nav-link text-white" aria-current="page">
                <i class="bi bi-house-door me-2"></i>
                داشبورد
            </a>
        </li>
        @if(auth()->user()->role != 'user')
        <li>
            <a href={{ route('dashboard.posts') }} class="nav-link text-white">
                <i class="bi bi-speedometer2 me-2"></i>
                پست های شما
            </a>
        </li>
        <li>
            <a href={{ route('dashboard.author.comments') }} class="nav-link text-white">
                <i class="bi bi-speedometer2 me-2"></i>
                کامنت های پست ها
            </a>
        </li>
        <li>
            <a href={{ route('dashboard.comments') }} class="nav-link text-white">
                <i class="bi bi-gear me-2"></i>
                کامنت های شما
            </a>
        </li>
        @endif
    </ul>
</div>