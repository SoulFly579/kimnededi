<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('author/dashboard')}}">
            <div class="sidebar-brand-text ">Kim Ne Dedi Yazar Yönetim Paneli</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if(Request::segment(2)=='dashboard') active @endif">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            İçerik Yönetimi
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" @if(Request::segment(2) == 'articles') style="color:white!important;" @endif href="{{url('admin/articles')}}">
                <i class="fas fa-fw fa-edit"@if(Request::segment(2) == 'articles') style="color:white!important;" @endif></i>
                <span>Makaleler</span>
            </a>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" @if(Request::segment(2) == 'categories') style="color:white!important;" @endif href="{{url('admin/categories')}}">
                <i class="fas fa-fw fa-list"@if(Request::segment(2) == 'categories') style="color:white!important;" @endif></i>
                <span>Kategoriler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if(Request::segment(2)=='users') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-address-book"></i>
                <span>Yazarlar</span>
            </a>
            <div id="collapseTwo" class="collapse  @if(Request::segment(2)=='authors') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Yazar İşlemleri:</h6>
                    <a class="collapse-item @if(Request::segment(2)=='authors' and !Request::segment(3)) active @endif" href="{{url('admin/authors')}}">Tüm Yazarlar</a>
                    <a class="collapse-item @if(Request::segment(2)=='authors' and Request::segment(3)=='create') active @endif" href="{{url('admin/authors/create')}}">Yazar Kayıt Et</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if(Request::segment(2)=='announcements') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#announcements"
               aria-expanded="true" aria-controls="announcements">
                <i class="fas fa-bullhorn"></i>
                <span>Duyurular</span>
            </a>
            <div id="announcements" class="collapse  @if(Request::segment(2)=='announcements') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Duyuru İşlemleri:</h6>
                    <a class="collapse-item @if(Request::segment(2)=='announcements' and !Request::segment(3)) active @endif" href="{{url('admin/announcements')}}">Tüm Duyurular</a>
                    <a class="collapse-item @if(Request::segment(2)=='announcements' and Request::segment(3)=='create') active @endif" href="{{url('admin/announcements/create')}}">Duyuru Yayınla</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if(Request::segment(2)=='announcements') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#premiums"
               aria-expanded="true" aria-controls="premiums">
                <i class="fas fa-bullhorn"></i>
                <span>Premium</span>
            </a>
            <div id="premiums" class="collapse  @if(Request::segment(2)=='premiums') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Premium İşlemleri:</h6>
                    <a class="collapse-item @if(Request::segment(2)=='premiums' and !Request::segment(3)) active @endif" href="{{url('admin/premiums')}}">Premim Ekle/Görüntüle</a>
                    <a class="collapse-item @if(Request::segment(2)=='premiums' and Request::segment(3)=='give') active @endif" href="{{url('admin/premiums/give')}}">Premium Ver</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" @if(Request::segment(2) == 'site') style="color:white!important;" @endif href="{{url('admin/site/settings')}}">
                <i class="fas fa-sliders-h"></i>
                <span>Site Ayarları</span>
            </a>
        </li><!--
        <li class="nav-item">
            <a class="nav-link" @if(Request::segment(2) == 'saying') style="color:white!important;" @endif href="{{url('admin/saying')}}">
                <i class="fas fa-podcast"></i>
                <span>Söz Seçenekleri</span>
            </a>
        </li>-->
        <!-- Divider -->
        <hr class="sidebar-divider">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ayarlar
                            </a>
                            <!--<a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Admin Aktiviterleri
                            </a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    <a href="{{url('/')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-globe fa-sm text-white-50"></i> Siteyi Görüntüle</a>
                </div>

                <!-- Content Row -->
