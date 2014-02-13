@extends('layouts.admin')

@section('title')
{{ $article->subject }}
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
        <a href="{{ URL::route('admin.article.edit', array($article->urls)) }}" class="btn btn-primary btn-block"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
        <hr />
        <label>Subjek :</label>
        <br />
        {{ $article->subject }}<hr />
        <label>URL :</label>
        <br />
        <a href="{{ URL::route('artikel', array($article->urls)) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-external-link fa-fw"></i> Buka</a>
    </div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
<script>
$(document).ready(function() {
    $('#menu_artikels, #menu_menu').addClass('active');
    prettyPrint();
});
</script>
@endsection