@extends('ssh.dashboard')

@section('owner')
vespa.eddytech03.com
@endsection

@section('cmd')
<button class="btn btn-primary" id="pull" system="vespa"><i class="fa fa-download fa-fw"></i> Pull</button> <code>git pull</code>
@endsection