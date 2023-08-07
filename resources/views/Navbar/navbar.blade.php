
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">{{config('app.name')}}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link @if(Request::route()->getName()=='Home')active @endif" aria-current="page" href="{{route('Home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::route()->getName()=='about')active @endif" aria-current="page" href="{{route('about')}}">About</a>
          </li>

        </ul>
      </div>
        <!-- Example single danger button -->


  <div class="btn-group">
    @guest
  <button type="button" class="btn btn-light dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false">
    My account
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
    <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>

  </ul>
  @endguest


  @auth
  <div class="btn-group">

  <button type="button" class="btn btn-light dropdown-toggle"   data-bs-toggle="dropdown" aria-expanded="false">
   {{Auth::user()->name}}
  </button>
   <ul class="dropdown-menu">
   <li><a class="dropdown-item" href="{{route('app_logout')}}">Logout</a></li>
   </ul>
   @endauth
  </div>
  </div>

  </nav>
