{{ HTML::script('components/jquery/dist/jquery.min.js') }}
{{ HTML::script('components/bootstrap/dist/js/bootstrap.min.js') }}
{{ HTML::script('components/angular/angular.min.js') }}
{{ HTML::script('components/angular-route/angular-route.min.js') }}
{{ HTML::script('components/angular-sanitize/angular-sanitize.min.js') }}
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
{{ HTML::script('assets/js/eddytech03/app.js?id=1') }}
{{ HTML::script('assets/js/eddytech03/controllers.js?id=1') }}
{{ HTML::script('assets/js/eddytech03/articles.js?id=1') }}

@yield('script')
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

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