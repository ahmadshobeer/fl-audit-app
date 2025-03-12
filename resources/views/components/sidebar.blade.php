<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand" href="#">
                <b class="logo-icon text-center">
                    <img src="{{asset('images/logo_arita.png')}}" width="40%"><br>
                </b>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="#" data-sidebartype="mini-sidebar">
                        <i class="icon-arrow-left-circle"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('images/avrifan.jpeg')}}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                            <div class=""><img src="{{asset('images/avrifan.jpeg')}}" alt="user" class="rounded" width="80"></div>
                            <div class="ml-2">
                                <h4 class="mb-0">Rifan Hardiyan</h4>
                                <p class=" mb-0">rifan@arita.co.id</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="/"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="/" aria-expanded="false">
                        <i class="fas fa-home mr-2"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i> 
                    <span class="hide-menu">Data Master</span>
                </li>
                
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="/struktur-organisasi" aria-expanded="false">
                        <i class="fas fa-retweet mr-2"></i>
                        <span class="hide-menu">Struktur Organisasi</span>
                    </a>
                </li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="/sop" aria-expanded="false">
                        <i class="fas fa-sign-language mr-2"></i>
                        <span class="hide-menu">SOP</span>
                    </a>
                </li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="../jobdes" aria-expanded="false">
                        <i class="fas fa-file mr-2"></i>
                        <span class="hide-menu">Job Deskripsi</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../surat_tugas" aria-expanded="false">
                        <i class="fas fa-user-secret mr-2"></i>
                        <span class="hide-menu">Surat Tugas</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>