@extends('layouts.admin')

@section('title')
Web developer
@endsection

@section('style')
{{ HTML::style('assets/js/google-code-prettify/prettify.css') }}
{{ HTML::style('components/bootstrap-switch/build/css/bootstrap3/bootstrap-switch.min.css') }}
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
            <h3 class="remove-top-margin"><i class="fa fa-pencil fa-fw"></i> Ubah artikel</h3>
        </div>
        @if(Session::has('done'))
        <div class="alert alert-success">
            <i class="fa fa-info fa-fw"></i> {{ Session::get('done') }}
        </div>
        @endif
        <div id="editor">{{{ $markdown }}}</div>
        <div id="editor2"></div>
        <hr />
    </div>    
    <div class="col-sm-2">
        
        <button class="btn btn-info btn-sm btn-block" id="preview"><i class="fa fa-file-o fa-fw"></i> Pratonton</button>
        <button class="btn btn-primary btn-sm btn-block" id="save"><i class="fa fa-save fa-fw"></i> Simpan</button>
        <button class="btn btn-danger btn-sm btn-block" id="delete"><i class="fa fa-trash-o fa-fw"></i> Padam</button>
        <hr />
        <input type="text" name="uri" id="uri" class="form-control input-sm" placeholder="Topic URI register" value="{{ $subject }}" required />
        <input type="hidden" name="article-id" value="{{ $path . '.md' }}" />
        <hr />
        <label>Publish?</label> ------ <input type="checkbox" id="publish" {{ ($articles->status == 1)? 'checked' : '' }} class="switch-small" data-on="success" data-off="warning" data-on-label="Ya" data-off-label="Tidak">
        <hr />
        <textarea class="form-control" name="snippet" rows="10" placeholder="Snippet bagi artikel ini" required>{{ $articles->snippet }}</textarea>
    </div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/js/ace-builds-master/src-min-noconflict/ace.js') }}
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
{{ HTML::script('components/bootbox/bootbox.js') }}
{{ HTML::script('components/bootstrap-switch/build/js/bootstrap-switch.min.js') }}
<script>    
    var editor;
    $(document).ready(function() {
        //$('#menu-home').addClass('active');
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/markdown");
        $('#editor').height($(window).height() - 150);
        $('#editor2').slideUp();
        $('#publish').bootstrapSwitch();
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
        if($('textarea[name=snippet]').val().length == 0) {
            $('textarea[name=snippet]').focus();
            return false;
        }
        var urls = "{{ route('admin.article.update', array(Request::segment(3))) }}";
        $.ajax({
            url: urls,
            type: 'PUT',
            data: {
                markdown: editor.getSession().getValue(),
                subject: $('input[name=uri]').val(),
                filename: $('input[name=article-id]').val(),
                status: $('#publish').bootstrapSwitch('state'),
                snippet: $('textarea[name=snippet]').val()
            },
            success: function(msg) {
                //console.log(msg);
                window.location.href = msg;
            }
        });
    });
    $('#delete').click(function() {
        bootbox.confirm("Artikel ini akan dipadam, Ianya tidak boleh diundur semula!", function(result) {
            if(result) {
                var urls = "{{ route('admin.article.destroy', array(Request::segment(3))) }}";
                $.ajax({
                    url: urls,
                    type: 'DELETE',
                    data: {
                        filename: $('input[name=article-id]').val()
                    },
                    success: function(msg) {
                        //console.log(msg);
                        window.location.href = msg;
                    }
                });
            }
        }); 
    });
</script>
@endsection