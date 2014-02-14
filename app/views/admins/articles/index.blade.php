@extends('layouts.admin')

@section('title')
Artikel
@endsection

@section('style')
<style>
    td:nth-child(1) {
        width: 40px;
        text-align: center;
    }
    td:nth-child(3) {
        width: 70px;
        text-align: center;
    }
    th {
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-9 col-md-10 col-lg-10">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin"><i class="fa fa-list fa-fw"></i> Artikel</h3>
        </div>        
    </div>
    <div class="col-sm-3 col-md-2 col-lg-2">
        <a href="{{ route('admin.article.create') }}" class="btn btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i> Cipta post baru</a>
    </div>
    <div class="col-xs-12">
        @if(count($articles) == 0)
        <div class="alert alert-info">
            <i class="fa fa-info fa-fw"></i> Artikel masih tiada didalam website
        </div>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subjek</th>
                    <th>Buka</th>
                </tr>
            </thead>
            <tbody>
            @foreach($articles as $row)
                <tr>
                    <td></td>
                    <td>{{ $row->subject }}</td>
                    <td><a href="{{ URL::route('admin.article.show', array(camel_case($row->urls))) }}"><i class="fa fa-pencil fa-fw"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#menu_artikels, #menu_menu').addClass('active');
});
</script>
@endsection