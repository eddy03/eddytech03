@extends('layouts.admin')

@section('title')
Web developer
@endsection

@section('style')
{{ HTML::style('assets/js/google-code-prettify/prettify.css') }}
<style type="text/css" media="screen">
    #editor { 
        height: 600px;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-10">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin"><i class="fa fa-pencil fa-fw"></i> Cipta artikel baru</h3>
        </div>
        <div id="alertbox"></div>        
        <div id="editor"></div>
        <div id="editor2"></div>
        <hr />
    </div>    
    <div class="col-sm-2">
        <button class="btn btn-info btn-sm btn-block" id="preview"><i class="fa fa-file-o fa-fw"></i> Pratonton</button>
        <button class="btn btn-primary btn-sm btn-block" id="save"><i class="fa fa-save fa-fw"></i> Simpan</button>
        <button class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash-o fa-fw"></i> Padam</button>
        <hr />
        <input type="text" name="uri" id="uri" class="form-control input-sm" placeholder="Topic URI register" required />
    </div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/js/ace-builds-master/src-min-noconflict/ace.js') }}
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
<script>    
    var editor;
    $(document).ready(function() {
        //$('#menu-home').addClass('active');
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/markdown");
        $('#editor2').slideUp();        
    });
    $('#preview').click(function() {
        if($('#editor').is(":visible")) {
            var urls = "{{ route('admin.preview') }}";
            $.ajax({
                url: urls,
                type: 'POST',
                data: {
                    markdown: editor.getSession().getValue()
                },
                beforeSend: function(msg) {
                    $('#editor').slideUp('slow', function() {
                        $('#editor2').slideDown();
                    });
                },
                success: function(msg) {
                    $('#editor2').html(msg);
                    prettyPrint();
                }
            });
        }
        else {
            $('#editor2').slideUp('slow', function() {
                $('#editor').slideDown();
            });
        }
    });
    $('#save').click(function() {
        if($('input[name=uri]').val().length == 0) {
            $('input[name=uri]').focus();
            return false;
        }
        var urls = "{{ route('admin.article.store') }}";
        $.ajax({
            url: urls,
            type: 'POST',
            data: {
                markdown: editor.getSession().getValue(),
                subject: $('input[name=uri]').val()
            },
            success: function(msg) {
                window.location.href = msg;
            }
        });
    });
</script>
@endsection