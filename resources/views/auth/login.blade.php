@extends('welcome')
@section('title','Login')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <h1 class="text-center text-muted mb-3 mt-5">Please sign in</h1>
            <p class="text-center text-muted mb-4">your articles are waiting for you.</p>
            <form method="POST" action="{{route('login')}}">
               @csrf
               @if (Session::has('success'))
                  <div class="alert alert-warning text-center" role="alert">
                     {{Session::get('success')}}

                    </div>

                 @endif
               @error('email')
               <div class="alert alert-danger text-center" role="alert">
                {{$message}}
              </div>
               @enderror

               @error('password')
               <div class="alert alert-danger text-center" role="alert">
                {{$message}}
              </div>
               @enderror
               <label for="email">Email</label><!---il for si je clique sur la label le curseur se met dans la blasa ---->
               <input type="email" name="email" id="email" class="form-control mb-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control mb-3 @error('password') is-invalid @enderror" required autocomplete="current-password">
                <div class="row mb-3">

                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="remember" name="remember" {{old('remember')?'checked':''}}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                    </div>

                    <div class="col-md-6 text-end">
                            <a href="#">Forgot password</a>
                    </div>
                </div>
                <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Sign in</button>
                </div>


                <p class="text-center text-muted mt-5">Not registred yet ? <a href="{{route('register')}}">create an account</p>

            </form>
        </div>

    </div>

  </div>

@endsection

