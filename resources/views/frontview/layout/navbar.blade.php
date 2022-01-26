  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:iiumcharity@gmail.com">student4charity@gmail.com</a></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://twitter.com/studentxcharity" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/StudentXCharity" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
      </div>
    </div>
  </section><!-- End Top Bar-->
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
          <li><a class="{{ (request()->is('/')) ? 'nav-link scrollto active' : 'nav-link' }}" href="{{route('/')}}">Home</a></li>
          <li><a class="{{ (request()->is('donation')) ? 'nav-link scrollto active' : 'nav-link' }}" href="{{route('donation')}}">Donate</a></li>
          <li><a class="{{ (request()->is('event')) ? 'nav-link scrollto active' : 'nav-link' }}" href="{{route('list.event')}}">Event</a></li>
        @if(Auth::check())
          <li class="dropdown">
              <a href="#">
                @if(Auth::user()->profile_photo_path == NULL)
                  <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/profile-photos/default.png" alt="">
                @else 
                  <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/{{Auth::user()->profile_photo_path}}" alt="">
                @endif
                <span>{{Auth::user()->name}}</span>              
                <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                  <a href="{{route('dashboard')}}">
                    Dashboard 
                  </a>
              </li>
              <li><a href="{{route('logout')}}">Logout</a></li>
            </ul>
          </li>
          @else 
            <li><a class="{{ (request()->is('login')) ? 'nav-link scrollto active' : 'nav-link' }}" href="{{ route('login') }}">Login</a></li>
            <li><a class="{{ (request()->is('register')) ? 'nav-link scrollto active' : 'nav-link' }}" href="{{ route('register') }}">Register</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->