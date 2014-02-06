@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-9 col-md-10 col-lg-10">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin">Artikel</h3>
        </div>        
    </div>
    <div class="col-sm-3 col-md-2 col-lg-2">
        <a href="{{ route('admin.article.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-pencil fa-fw"></i> Cipta post baru</a>
    </div>
    <div class="col-xs-12">
        dasdas
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    //$('#menu-home').addClass('active');
});
</script>
@endsection