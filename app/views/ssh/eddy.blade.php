@extends('ssh.dashboard')

@section('owner')
eddytech03.com
@endsection

@section('cmd')
<button class="btn btn-primary" class="pull" cmd="git pull" system="website"><i class="fa fa-download fa-fw"></i> Pull Website</button> <code>git pull</code>
<br />
<br />
<button class="btn btn-primary" class="pull" cmd="git pull" system="spaghetti"><i class="fa fa-download fa-fw"></i> Pull Spaghetti</button> <code>git pull</code>
<br />
<br />
<button class="btn btn-primary" class="pull" cmd="git pull" system="ewakaf"><i class="fa fa-download fa-fw"></i> Pull eWakaf</button> <code>git pull</code>
<br />
<br />
<button class="btn btn-primary" class="pull" cmd="git pull" system="vespa"><i class="fa fa-download fa-fw"></i> Pull Vespa</button> <code>git pull</code>
@endsection