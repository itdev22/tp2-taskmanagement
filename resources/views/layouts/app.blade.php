<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @yield('css')
</head>
<body>
    <div>
        @if (request()->path() != '/')
        @include('layouts.navbar')
        @endif
        <div class="{{request()->path() == '/' ? "":"mt-32" }}">
            @yield('content')
        </div>
    </div>
</body>
@yield('js')

</html>
