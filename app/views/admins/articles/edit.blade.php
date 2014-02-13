@extends('layouts.admin')

@section('title')
Mengubah artikel {{ $articles->subject }}
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
@include('admins.articles.editors')
@endsection

@section('script')
{{ HTML::script('assets/js/ace-builds-master/src-min-noconflict/ace.js') }}
{{ HTML::script('assets/js/google-code-prettify/prettify.js') }}
{{ HTML::script('components/bootbox/bootbox.js') }}
{{ HTML::script('components/bootstrap-switch/build/js/bootstrap-switch.min.js') }}
<script>    
    var editor;
    $(document).ready(function() {
        $('#menu_artikels, #menu_menu').addClass('active');
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/markdown");
        editor.getSession().setUseWrapMode(true);
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
        if($('input[name=subject]').val().length == 0) {
            $('input[name=subject]').focus();
            return false;
        }
        if($('input[name=urls]').val().length == 0) {
            $('input[name=urls]').focus();
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
                subject: $('input[name=subject]').val(),
                urls: $('input[name=urls]').val(),
                articleID: $('input[name=article-id]').val(),
                status: $('#publish').bootstrapSwitch('state'),
                snippet: $('textarea[name=snippet]').val()
            },
            success: function(msg) {
                if(msg.indexOf('error') > -1)
                    console.log(msg);
                else {
                    var code = '<div class="alert alert-success">\n\
                                    <i class="fa fa-info fa-fw"></i> Artikel telah berjaya dikemaskini\n\
                                </div>';
                    $('#notification').html(code).slideDown('slow');
                    setTimeout(function() {
                        $('#notification').slideUp('slow', function() {
                            $('#notification').empty()
                        });
                    }, 4000);
                }
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
                        aID: $('input[name=article-id]').val()
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