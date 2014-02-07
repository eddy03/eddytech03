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
            <ul class="nav navbar-nav navbar-right">
                <li id="menu-home"><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Utama</a></li>                
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list fa-fw"></i> Menu <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.article.index') }}"><i class="fa fa-file-text-o fa-fw"></i> Artikel</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
                @else
                <li id="menu-project"><a href="{{ route('project') }}"><i class="fa fa-gear fa-fw"></i> Projek</a></li>
                <li id="menu-about"><a href="{{ route('about') }}"><i class="fa fa-user fa-fw"></i> Tentang saya</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>