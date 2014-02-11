@extends('layouts.master')

@section('title')
Maklumat Akaun
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin">Maklumat akaun : {{ Auth::user()->email }}</h3>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="alert alert-warning">
            <strong>
                <i class="fa fa-warning fa-fw"></i> Anda akan di-log keluar secara automatik selepas menyimpan maklumat dibawah
            </strong>
        </div>
        {{ Form::open(array('route' => 'admin.akaun.cipta', 'class' => 'form-horizontal', 'role' => 'form')) }}
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Klassifikasi Akaun</label>
                <div class="col-sm-10">
                    <p class="form-control-static">
                        @if(Auth::user()->level == 1)
                        Super Admin
                        @else
                        Share holder
                        @endif
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email" required />
                    {{  $errors->first('email', '<span class="help-block"><span class="text-danger"><i class="fa fa-warning fa-fw"></i> :message</span></span>') }}
                </div>
            </div>
            <div class="form-group">
                <label for="katalaluan" class="col-sm-2 control-label">Kata laluan</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="katalaluan" name="katalaluan" placeholder="Kata Laluan baru">
                    <span class="help-block">
                        <i class="fa fa-info fa-fw"></i> Sila kosongkan ruangan ini sekiranya tidak ingin menukar kata laluan
                        {{  $errors->first('katalaluan', '<br /><span class="text-danger"><i class="fa fa-warning fa-fw"></i> :message</span>') }}
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save fa-fw"></i> Simpan</button>
                </div>
            </div>
        {{ Form::close() }}
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