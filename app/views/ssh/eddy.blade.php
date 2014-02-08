@extends('ssh.dashboard')

@section('owner')
eddytech03.com
@endsection

@section('cmd')
<button class="btn btn-primary" id="pull" system="website"><i class="fa fa-download fa-fw"></i> Pull Website</button> <code>git pull</code>
<br />
<br />
<button class="btn btn-primary" id="pull" system="spaghetti"><i class="fa fa-download fa-fw"></i> Pull Spaghetti</button> <code>git pull</code>
@endsection