@extends('layouts.master')

@section('title')
{{ $articles->subject }}
@endsection

@section('style')
{{ HTML::style('assets/js/google-code-prettify/prettify.css') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="read-articles">
            {{ $markdown }}
        </div>
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