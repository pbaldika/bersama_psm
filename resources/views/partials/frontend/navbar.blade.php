<ul>

    <!-- <li class="dropdown"><a href="#"><span>Home</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="index.html" class="active">Home 1 - index.html</a></li>
              <li><a href="index-2.html">Home 2 - index-2.html</a></li>
              <li><a href="index-3.html">Home 3 - index-3.html</a></li>
              <li><a href="index-4.html">Home 4 - index-4.html</a></li>
            </ul>
          </li> -->
    @guest
        <li><a class="nav-link scrollto" href="{{ route('landing') }}#beranda">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{ route('investment-list') }}#projects">Projek</a></li>
        <li><a class="nav-link scrollto" href="index.html#services">Tentang Kami</a></li>
    @else
    @if (Auth::user()->role == 'user')
        <li><a class="nav-link scrollto" href="{{ route('landing') }}#beranda">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{ route('investment-list') }}#projects">Projek</a></li>
        <li><a class="nav-link scrollto" href="{{ route('investment-made') }}#portofolio">Portofolio</a></li>
        <li><a class="nav-link scrollto" href="index.html#services">Tentang Kami</a></li>
        {{-- <li><a href="blog.html">Blog</a></li> --}}
    @elseif(Auth::user()->role == 'company')
        <li><a class="nav-link scrollto" href="{{ route('landing') }}#beranda">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{ route('funding') }}#pengajuan">Pengajuan Dana</a></li>
        <li><a class="nav-link scrollto" href="{{ route('funding-list') }}#funding">Daftar Pengajuan Dana</a></li>
        <li><a class="nav-link scrollto" href="index.html#services">Tentang Kami</a></li>
        {{-- <li><a href="blog.html">Blog</a></li> --}}
    @elseif(Auth::user()->role == 'admin')
        <li><a class="nav-link scrollto" href="{{ route('landing') }}#beranda">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{ route('admin.home') }}#projects">Beranda Admin</a></li>
        <li><a class="nav-link scrollto" href="{{ route('investment-list') }}#projects">Projek</a></li>
        <li><a class="nav-link scrollto" href="{{ route('investment-made') }}#portofolio">Portofolio</a></li>
        <li><a class="nav-link scrollto" href="index.html#services">Tentang Kami</a></li>
    @endif
    @endguest


    {{-- <li class="dropdown megamenu"><a href="#"><span>Mega Menu</span> <i
                class="bi bi-chevron-down dropdown-indicator"></i></a>
        <ul>
            <li>
                <a href="#">Column 1 link 1</a>
                <a href="#">Column 1 link 2</a>
                <a href="#">Column 1 link 3</a>
            </li>
            <li>
                <a href="#">Column 2 link 1</a>
                <a href="#">Column 2 link 2</a>
                <a href="#">Column 3 link 3</a>
            </li>
            <li>
                <a href="#">Column 3 link 1</a>
                <a href="#">Column 3 link 2</a>
                <a href="#">Column 3 link 3</a>
            </li>
            <li>
                <a href="#">Column 4 link 1</a>
                <a href="#">Column 4 link 2</a>
                <a href="#">Column 4 link 3</a>
            </li>
        </ul>
    </li>
    <li class="dropdown"><a href="#"><span>Drop Down</span> <i
                class="bi bi-chevron-down dropdown-indicator"></i></a>
        <ul>
            <li><a href="#">Drop Down 1</a></li>
            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                        class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
            </li>
            <li><a href="#">Drop Down 2</a></li>
            <li><a href="#">Drop Down 3</a></li>
            <li><a href="#">Drop Down 4</a></li>
        </ul>
    </li> --}}
    <li><a class="nav-link scrollto" href="index.html#contact">Kontak Kami</a></li>
</ul>
<i class="bi bi-list mobile-nav-toggle d-none"></i>
</ul>
