@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin">Administration eddytech03</h3>
        </div>
        @if(Session::has('flash_errors'))
        <div class="alert alert-danger"><i class="fa fa-warning fa-fw"></i> {{ Session::get('flash_errors') }}</div>
        @endif
        {{ Form::open(array('route' => 'admin.auth')) }}
            <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input type="email" class="form-control" name="email" required placeholder="Email address">
            </div>
            <div class="between-two-form"></div>
            <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                <input type="password" class="form-control" name="password" required placeholder="Password">
            </div>
            <div class="between-two-form"></div>
            <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-sign-in fa-fw"></i> Login</button>
        {{ Form::close() }}
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