<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') | Edi Abdul Rahman</title>
        {{ HTML::style('components/bootswatch/united/bootstrap.min.css') }}
        {{ HTML::style('components/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/style.css') }}
        
        @yield('style')
    </head>
    
    <body>
        @include('menu.master')
        
        <div class="container">
            @yield('content')
        </div>        
        
        {{ HTML::script('components/jquery/jquery.min.js') }}
        {{ HTML::script('components/bootstrap/dist/js/bootstrap.min.js') }}
        @yield('script')
    </body>
</html>