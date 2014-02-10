@extends('layouts.master')

@section('title')
{{ $articles->subject }}
@endsection

@section('style')
{{ HTML::style('assets/js/google-code-prettify/prettify.css') }}
<style>
    #disqus_thread {
        margin-top: 20px;
        background: #fff;
        padding: 15px 15px 25px 15px;
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 3px 2px 1px #ccc;
        box-shadow: 0 3px 2px 1px #ccc;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="read-articles">
            {{ $markdown }}
        </div>
        <div id="disqus_thread"></div>
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
    
    </div>
    <div class="col-md-2">
        <i class="fa fa-calendar fa-fw"></i> {{ date('d-m-Y', strtotime($articles->created_at)) }}
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