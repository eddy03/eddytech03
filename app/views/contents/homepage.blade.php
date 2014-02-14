@extends('layouts.master')

@section('title')
Selamat datang
@endsection

@section('style')
<style>
    a {
        color: #222222;
        text-decoration: none;
    }
    a:hover {
        text-decoration: none;
    }
    .articles h2 {
        text-transform: capitalize;
    }
    .search-query-nav {
        margin-top: 3px;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-9">
        @if(count($articles) > 0)
        <div class="col-xs-12 text-right">
            {{ $articles->links() }}
        </div>
        <div class="clearfix"></div>
        @foreach($articles as $row)
        <div class="col-xs-12 articles">
            <h2 class="page-header">
                <a href="{{ URL::route('artikel', array($row->urls)) }}">{{ $row->subject }}</a>
                @if(Auth::check())
                <a href="{{ URL::route('admin.article.edit', array($row->urls)) }}"><i class="fa fa-edit fa-fw pull-right" title="Ubah artikel ini"></i></a>
                @endif
            </h2>
            <p>
                {{ $row->snippet }}
            </p>
        </div>
        <div class="clearfix"></div>
        <hr />
        @endforeach
        @else
        <div class="alert alert-info">
            <i class="fa fa-meh-o fa-fw"></i> Tiada artikel untuk dipaparkan..... 
        </div>
        @endif
    </div>
    <div class="visible-xs">
        <hr />
    </div>
    <div class="col-sm-3">
        @include('contents.sub_sidebar')
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#menu-home').addClass('active');
    setTimeout(function() {
        $('.articles').addClass('animated pulse');
    }, 1000);
});
$('.home-btn').click(function() {
    window.location.href = $(this).attr('url');
});
</script>
@endsection