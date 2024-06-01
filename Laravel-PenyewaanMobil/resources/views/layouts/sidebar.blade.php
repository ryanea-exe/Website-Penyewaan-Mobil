<ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                @if(Auth::user()->foto == '')

                  <img src="{{asset('images/user/default.png')}}" alt="profile image">
                @else

                  <img src="{{asset('images/user/'. Auth::user()->foto)}}" alt="profile image">
                @endif
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->nama}}</p>
                  <div>
                    <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">{{ Auth::user()->level }}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item {{ setActive(['/', 'home']) }}"> 
            <a class="nav-link" href="{{url('/')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(Auth::user()->level == 'admin')
          <li class="nav-item {{ setActive(['customers*', 'brand*', 'mobil*', 'user*']) }}">
            <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ setShow(['customer*', 'brand*', 'mobil*', 'user*']) }}" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link {{ setActive(['customer*']) }}" href="{{route('customer.index')}}">Data Customer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ setActive(['brand*']) }}" href="{{route('brand.index')}}">Data Brand</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ setActive(['mobil*']) }}" href="{{route('mobil.index')}}">Data Mobil</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link {{ setActive(['user*']) }}" href="{{route('user.index')}}">Data User</a>
                </li>
              </ul>
            </div>
          </li>
          @elseif(Auth::user()->level == 'user')
          <li class="nav-item {{ setActive(['customers*', 'brand*', 'mobil*']) }}">
            <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ setShow(['customer*', 'brand*', 'mobil*']) }}" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link {{ setActive(['customer*']) }}" href="{{route('customer.index')}}">Data Customer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ setActive(['brand*']) }}" href="{{route('brand.index')}}">Data Brand</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ setActive(['mobil*']) }}" href="{{route('mobil.index')}}">Data Mobil</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item {{ setActive(['transaksi*']) }}">
            <a class="nav-link" href="{{route('transaksi.index')}}">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-laporan" aria-expanded="false" aria-controls="ui-laporan">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-laporan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('laporan/trs')}}">Laporan Transaksi</a>
                </li>
                <!--
                <li class="nav-item">
                  <a class="nav-link" href="">Laporan Customer</a>
                </li>
                -->
                 <li class="nav-item">
                  <a class="nav-link" href="{{url('laporan/mobil')}}">Laporan Mobil</a>
                </li>
              </ul>
            </div>
          </li>
         
        </ul>