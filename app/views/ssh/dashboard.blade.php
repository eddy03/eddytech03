@extends('layouts.master')

@section('title')
System Management using Git
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin">Git system management <small>@yield('owner')</small></h3>
        </div>
    </div>
    <div class="col-lg-5">
        @yield('cmd')
    </div>
    <div class="col-lg-7">
        <pre id="message"></pre>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    
});
$('.pull').click(function() {
    var element = $(this);
    var urls = "{{ route('admin.ssh.cmd') }}";
    $.ajax({
        url: urls,
        data: {
            cmd: element.attr('cmd'),
            auth: '{{ Auth::user()->email }}',
            system: element.attr('system')
        },
        error: function(msg) {
            alert(msg.responseText);
        },
        success: function(msg) {
            console.log(msg);
            $('#message').html(msg.messages);
        }
    });
});
</script>
@endsection