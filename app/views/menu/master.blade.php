<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">eddytech03</a>
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control input-sm search-query-nav" name="query" value="{{ Input::get('query') }}" placeholder="Carian artikel..." required />
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li id="menu-home"><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Utama</a></li>                
                @if(Auth::check())
                @include('menu.admin_sub')
                @else
                <li id="menu-project"><a href="{{ route('project') }}"><i class="fa fa-gear fa-fw"></i> Projek</a></li>
                <li id="menu-about"><a href="{{ route('about') }}"><i class="fa fa-user fa-fw"></i> Tentang saya</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>