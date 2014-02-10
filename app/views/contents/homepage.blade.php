@extends('layouts.master')

@section('title')
Web developer
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
            <h2 class="page-header"><a href="{{ URL::route('artikel', array(str_replace('.md', '', $row->filename))) }}">{{ $row->subject }}</a></h2>
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
        <form role="form">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Carian artikel..." />
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button"><i class="fa fa-search fa-fw"></i></button>
                </span>
            </div>            
        </form>
        <hr />
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
</script>
@endsection