<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        @section('head')
        @show
    </head>
    <body>
        <h1>@yield('title')</h1>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
