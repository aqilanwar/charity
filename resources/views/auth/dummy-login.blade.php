@extends('frontview.master')
@section('title', 'Login')

@section('content')
    
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Login</h2>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <div class="col-sm-9 col-md-7 col-lg-4 mx-auto" style="min-height: 79vh">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
           <img src="{{asset('frontview/assets/img/logo-3.png')}}" class="img-fluid" style="margin:10px" height="90px" alt="logo">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email"  id="email" placeholder="name@example.com" required>
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                {{-- <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                    <label class="form-check-label" for="rememberPasswordCheck">
                        Remember password
                    </label>
                    <br>
                </div> --}}
                <div class="form-floating mb-3">
                    Dont have account ? 
                    <a class="text-primary" href="{{ route('register') }}">Sign up here</a>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login" type="submit">Log in</button>
                </div>
            </form>
          </div>
        </div>
      </div>
  

  </main><!-- End #main -->

  @endsection
