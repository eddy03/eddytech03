<div class="row">
    <div class="col-sm-10">
        <div class="page-header remove-top-margin">
            <h3 class="remove-top-margin"><i class="fa fa-pencil fa-fw"></i> {{ $condition or 'Cipta' }} artikel</h3>
        </div>
        <div id="notification"></div>
        <!-- Editor -->
        <div id="editor">{{{ $markdown or '' }}}</div>
        <!-- Preview the code -->
        <div id="editor2"></div>
        <hr />
    </div>    
    <div class="col-sm-2">
        <!-- Button and controls -->
        <button class="btn btn-info btn-sm btn-block" id="preview"><i class="fa fa-file-o fa-fw"></i> Pratonton</button>
        <button class="btn btn-primary btn-sm btn-block" id="save"><i class="fa fa-save fa-fw"></i> Simpan</button>
        @if( isset($condition) && $condition == 'Ubah' )
        <button class="btn btn-danger btn-sm btn-block" id="delete"><i class="fa fa-trash-o fa-fw"></i> Padam</button>
        <button class="btn btn-danger btn-sm btn-block" id="batal" urls="{{ route('admin.article.index') }}"><i class="fa fa-times fa-fw"></i> Batal</button>
        @else
        <button class="btn btn-danger btn-sm btn-block" id="batal" urls="{{ route('admin.article.index') }}"><i class="fa fa-times fa-fw"></i> Batal</button>
        @endif
        <hr />
        <input type="text" name="subject" id="subject" class="form-control input-sm" placeholder="Tajuk Utama" value="{{ $articles->subject or '' }}" required />
        @if( isset($condition) && $condition == 'Ubah' )
        <input type="hidden" name="urls" id="urls" class="form-control input-sm" placeholder="URL tetap" value="{{ $articles->urls or '' }}" required />
        @else
        <input type="text" name="urls" id="urls" class="form-control input-sm" placeholder="URL tetap" value="{{ $articles->urls or '' }}" required />
        @endif
        <input type="hidden" name="article-id" value="{{ $articles->id or '' }}" />
        <hr />
        @if( isset($condition) && $condition == 'Ubah' )
        <input type="checkbox" id="publish" {{ ($articles->status == 1)? 'checked' : '' }} class="switch-small" data-on="success" data-off="warning" data-on-label="Ya" data-off-label="Tidak"> <strong>Paparkan</strong>
        @else
        <input type="checkbox" id="publish" class="switch-small" data-on="success" data-off="warning" data-on-label="Ya" data-off-label="Tidak"> <strong>Paparkan</strong>
        @endif
        <hr />
        <textarea class="form-control" name="snippet" rows="10" placeholder="Snippet bagi artikel ini" required>{{ $articles->snippet or '' }}</textarea>
    </div>
</div>