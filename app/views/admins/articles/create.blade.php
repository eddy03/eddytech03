@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
<style type="text/css" media="screen">
    #editor { 
        height: 400px;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin"><i class="fa fa-pencil fa-fw"></i> Cipta artikel baru</h3>
        </div>
        <div id="editor"></div>
    </div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/js/ace-builds-master/src-min-noconflict/ace.js') }}
<script>
$(document).ready(function() {
    //$('#menu-home').addClass('active');
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/eclipse");
    editor.getSession().setMode("ace/mode/markdown");
});
</script>
@endsection