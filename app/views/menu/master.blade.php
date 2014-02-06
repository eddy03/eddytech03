<div class="navbar navbar-default navbar-fixed-top" role="navigation">
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
        <ul class="nav navbar-nav navbar-right navbar-fix-float">
            <li id="menu-home"><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Utama</a></li>
            <li id="menu-project"><a href="{{ route('project') }}"><i class="fa fa-gear fa-fw"></i> Projek</a></li>
            <li id="menu-about"><a href="{{ route('about') }}"><i class="fa fa-user fa-fw"></i> Tentang saya</a></li>
        </ul>
    </div>
</div>