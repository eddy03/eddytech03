@extends('layouts.master')

@section('title')
Log perkembangan eddytech03.com
@endsection

@section('style')
@endsection

@section('content')
<div class="page-header remove-top-margin">
    <h3 class="remove-margin">Log perkembangan eddytech03.com</h3>
</div>
<div class="row">
    <div class="col-sm-12">
        <p class="lead">13/02/2014</p>
        <ol>
            <li>Perubahan algorithm pada URL penciptaan artikel baru</li>
            <li>Jalan pintas untuk mengubah artikel (edit link)</li>
            <li>Perubahan pada database table articles</li>
        </ol>
        <p class="lead">14/02/2014 <i class="fa fa-heart fa-fw"></i></p>
        <ol>
            <li>Footer siap dibina</li>
        </ol>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
});
</script>
@endsection