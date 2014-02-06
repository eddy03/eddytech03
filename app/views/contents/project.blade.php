@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        List of my project / portfolio / playground
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#menu-project').addClass('active');
});
</script>
@endsection