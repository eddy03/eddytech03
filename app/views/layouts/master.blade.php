<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.meta')
	<title>@yield('title') | Edi Abdul Rahman</title>        
        
        {{ HTML::style('components/bootswatch/yeti/bootstrap.min.css') }}
        {{ HTML::style('components/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style('components/animate.css/animate.min.css') }}
        {{ HTML::style('assets/css/style.css?id=103') }}        
        @yield('style')
    </head>
    
    <body>
        @include('menu.master')
        
        <div class="page-wrap">
            <div class="container">
                @yield('content')
            </div>
        </div>
        
        <footer class="site-footer">
            @include('layouts.footer')
        </footer>
        
        {{ HTML::script('components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('components/bootstrap/dist/js/bootstrap.min.js') }}
        @yield('script')
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-44462725-1', 'eddytech03.com');
            ga('send', 'pageview');
        </script>
        <script>
            $(document).ready(function() {
                $('.navbar-brand').addClass('animated rollIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                    $('.navbar-brand').addClass('infine-color-shif');
                });
            });
        </script>
    </body>
</html>