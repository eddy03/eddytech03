<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') | Edi Abdul Rahman</title>
        {{ HTML::style('components/bootswatch/united/bootstrap.min.css') }}
        {{ HTML::style('components/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/style.css?id=101') }}
        {{ HTML::style('assets/css/admin.css?id=100') }}        
        @yield('style')
    </head>
    
    <body>
        @include('menu.admin')
        
        @yield('content')
        
        {{ HTML::script('components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('components/bootstrap/dist/js/bootstrap.min.js') }}
        @yield('script')
    </body>
</html>