@extends('layouts.admin')

@section('title')
Web developer
@endsection

@section('style')
{{ HTML::style('assets/js/google-code-prettify/prettify.css') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">
        {{ $markdown }}
    </div>
    <div class="col-lg-2">
        <a href="{{ URL::route('admin.article.edit', array($path)) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
        <hr />
        {{ $subject or '' }}
    </div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
<script>
$(document).ready(function() {
    //$('#menu-home').addClass('active');
    prettyPrint();
});
</script>
@endsection