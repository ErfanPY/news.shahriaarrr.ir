<!DOCTYPE html>
<html lang="fa" dir="rtl">
    @include('partials.head')
    <body class="d-flex">
        <x-sidebar />
        
        <div class="flex-grow-1 p-3">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            {{ $slot }}
        </div>
    </body>
</html>