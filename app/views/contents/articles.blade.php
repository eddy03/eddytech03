@extends('layouts.master')

@section('title')
{{ $articles->subject }}
@endsection

@section('style')
{{ HTML::style('assets/js/google-code-prettify/prettify.css') }}
<style>
    #disqus_thread {
        margin-top: 20px;
        padding-top: 10px;
    }
    .calendars {
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 text-right calendars">
        <i class="fa fa-calendar fa-fw"></i> Artikel ini dicipta pada : {{ date('d-m-Y', strtotime($articles->created_at)) }}
    </div>
    <div class="col-xs-12">
        <div class="read-articles">
            {{ $markdown }}
        </div>
        <div id="disqus_thread" class="read-articles"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'eddytech03'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        <hr />
        <p class="lead">
            <i class="fa fa-list fa-fw"></i> Artikel lain <i class="fa fa-ellipsis-v fa-fw"></i>
        </p>
    </div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
<script>
$(document).ready(function() {
    //$('#menu-about').addClass('active');
    prettyPrint();
});
</script>
@endsection