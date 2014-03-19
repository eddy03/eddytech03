@if(Auth::check())
<ul class="nav navbar-nav navbar-right">
    <li id="menu-home"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-fw"></i> Utama</a></li>
    <li class="dropdown" id="menu_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list fa-fw"></i> Menu <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li id="menu_artikels"><a href="{{ route('admin.article.index') }}"><i class="fa fa-file-text-o fa-fw"></i> Artikel</a></li>
            <li id="menu-git"><a href="{{ route('admin.ssh.dashboard') }}"><i class="fa fa-github fa-fw"></i> Git System Command</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Akaun</li>
            <li><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Ke Halaman utama</a></li>
            <li><a href="{{ route('home') }}" target="_blank"><i class="fa fa-external-link fa-fw"></i> Ke Halaman utama (new tab)</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Akaun</li>
            <li id="menu_akaun" class="menu-akaun"><a href="{{ route('admin.akaun') }}"><i class="fa fa-wrench fa-fw"></i> Maklumat Akaun</a></li>
            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Log Keluar</a></li>
        </ul>
    </li>
</ul>
@endif