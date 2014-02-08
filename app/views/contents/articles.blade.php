@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        About me page
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#menu-about').addClass('active');
});
</script>
@endsection