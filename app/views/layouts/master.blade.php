<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.meta')
	<title>@yield('title') | Edi Abdul Rahman</title>        
        
        {{-- HTML::style('components/bootswatch/yeti/bootstrap.min.css') --}}
        {{ HTML::style('components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ HTML::style('components/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style('components/animate.css/animate.min.css') }}
        {{ HTML::style('assets/css/style.css?id=104') }}
        {{ HTML::style('assets/css/overwriteBootstrap.css?id=104') }}
        @yield('style')
    </head>
    
    <body>
               
        <div class="page-wrap" ng-app="website">
            @include('menu.master')
            <div class="main-topic" ng-if="heading.need == true">
                <div class="container">
                    <div class="page-header">
                        <h1>@{{ heading.main }}</h1>
                        <p>
                            @{{ heading.description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="container main-content-block">
                <ng-view></ng-view>
            </div>
        </div>
        
        <footer class="site-footer">
            @include('layouts.footer')
        </footer>
        
        @include('layouts.scripts')
    </body>
</html>