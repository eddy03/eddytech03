<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list fa-fw"></i> Menu <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('admin.article.index') }}"><i class="fa fa-file-text-o fa-fw"></i> Artikel</a></li>
        <li id="menu-git"><a href="{{ route('admin.ssh.dashboard') }}"><i class="fa fa-github fa-fw"></i> Git System Command</a></li>
        <li class="divider"></li>
        <li class="dropdown-header">Akaun</li>
        <li class="menu-akaun"><a href="{{ route('admin.akaun') }}"><i class="fa fa-wrench fa-fw"></i> Maklumat Akaun</a></li>
        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Log Keluar</a></li>
    </ul>
</li>