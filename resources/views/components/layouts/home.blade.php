<!DOCTYPE html>
<html lang="fa" dir="rtl">
    @include('partials.head')
    <body>
        <x-header />
        @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
        {{ $slot }}
        <x-footer />
    </body>
</html>
