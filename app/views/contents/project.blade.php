@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
<style>
    .split {
        height: 50px;
    }
</style>
@endsection

@section('content')
<div class="page-header remove-top-margin">
    <h3 class="remove-margin">Senarai projek / portfolio / playground</h3>
</div>
<div class="row">
    <div class="col-xs-12">
        <ol>
            <li>spaghetti system <span class="text-danger"><i class="fa fa-warning fa-fw"></i> Development phase!</span></li>
            <li>SCMS system <span class="text-danger"><i class="fa fa-warning fa-fw"></i> Development phase!</span></li>
            <li>eWakaf system <span class="text-danger"><i class="fa fa-warning fa-fw"></i> Development phase!</span></li>
        </ol>
        <div class="split"></div>
        * Kandungan maklumat didalam bahagian ini masih didalam pembinaan.
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