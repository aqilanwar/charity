@extends('frontview.master')
@section('title', 'Register')

@section('content')
    
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Register</h2>
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
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="Muhammad Akmal" name="name" value="{{old('name')}}" required >
                    <label for="name">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email" value="{{old('email')}}" required >
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="matric_id" id="matric_id" value="{{old('matric_id')}}" required  placeholder="100010001000">
                    <label for="matric_id">Matric ID</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control"  name="password"  id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation"  id="password_confirmation" placeholder="Confirm Password">
                    <label for="password_confirmation">Confirm Password</label>
                </div>

                <div class="form-floating mb-3">
                    Already register ? 
                    <a class="text-primary " href="{{ route('login') }}">Login here</a>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login " type="submit">Sign up</button>
                </div>
            </form>
          </div>
        </div>
      </div>
  

  </main><!-- End #main -->

  @endsection
