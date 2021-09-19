
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div id="logo">
        <!-- <h1><a href="index.html">Reve<span>al</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="{{route('/')}}"><img src="{{asset('frontview/assets/img/logo-3.png')}}" height="90px" alt=""></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="{{route('list.event')}}">Charity Event</a></li>

        @if(Auth::check())
          <li class="dropdown">
              <a href="#">
                <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/{{Auth::user()->profile_photo_path}}" alt="">
                <span>{{Auth::user()->name}}</span>              
                <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                  <a href="{{route('dashboard')}}">
                    Profile 
                  </a>
              </li>
              {{-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">dd2</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> --}}
              <li><a href="{{route('logout')}}">Logout</a></li>
            </ul>
          </li>
          @else 
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->