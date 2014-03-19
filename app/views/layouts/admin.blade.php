<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Edi Abdul Rahman</title>
        {{ HTML::style('components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ HTML::style('components/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/style.css?id=101') }}
        {{ HTML::style('assets/css/admin.css?id=100') }}        
        @yield('style')
    </head>

    <body>
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">eddytech03</a>
            </div>
            <div class="navbar-collapse collapse">
                @include('menu.admin')
            </div>
        </div>

        @yield('content')

        {{ HTML::script('components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('components/bootstrap/dist/js/bootstrap.min.js') }}
        @yield('script')
    </body>
</html>