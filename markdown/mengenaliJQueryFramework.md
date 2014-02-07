Dikala malam tiba
================

<?prettify?>
```
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
                $('#alertbox').html('<div class="alert alert-success"><i class="fa fa-info fa-fw"></i> Artikel telah disimpan</div>');
                setTimeout(function(){$('#alertbox').empty()},4000);
            }
        });
    });
</script>
```
tetetetetttte   
tdasttsds