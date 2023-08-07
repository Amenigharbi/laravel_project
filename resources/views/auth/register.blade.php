@extends('welcome')

@section('title','Register')

@section('content')
   <div class="container">
    <div class="row">
            <div class="col-md-5 mx-auto"><!--col md 6 ma3neha l'ecran de type medium wil colonne de largeur 6 sur 12---><!-- mx auto ma3neha centrer horizontalement l'element à l'interieur de sa colonne parente-->
                <h1 class="text-center text-muted mb-3 mt-5">Register please</h1>
                <p class="text-center text-muted mb-5">Create an account if you don't have one.</p>
                <form method="POST" action="{{route('register')}}" class="row g-3" id="form-register">
                    @csrf
                    <div class=" col md-6">
                        <label for="FirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{old('FirstName')}}" required autocomplete="FirstName" autofocus>
                        <small class="text-danger fw-bold" id="error-register-firstname"></small>
                      </div>
                      <div class="col-md-6">
                        <label for="LastName" class="form-label">LastName</label>
                        <input type="text" class="form-control" name="LastName" id="LastName" value="{{old('LastName')}}" required autocomplete="LastName" autofocus>
                        <small class="text-danger fw-bold" id="error-register-Lastname"></small>
                      </div>
                      <div class="col-md-12">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{old('email')}}" required autocomplete='email' url_email_exist="{{route('app_email_exist')}}" token="{{ csrf_token() }}">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        <small class="text-danger fw-bold" id="error-register-email"></small>
                      </div>

                      <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}">
                        <small class="text-danger fw-bold" id="error-register-password"></small>
                      </div>
                      <div class="col-md-6">
                        <label for="PasswordConfirm" class="form-label">Password Confirm</label>
                        <input type="password" class="form-control" name="PasswordConfirm"id="PasswordConfirm" value="{{old('PasswordConfirm')}}">
                        <small class="text-danger fw-bold" id="error-register-password-confirm"></small>
                      </div>
                      <div class="col-md-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="agreeTerms">
                        <label class="form-check-label" for="agreeTerms">Agree Terms</label><br>
                        <small class="text-danger fw-bold" id="error-register-agreeTerms"></small>
                      </div>
                      </div>

                      <div class="d-grid gap-2">
                      <button type="button" class="btn btn-outline-primary" id="register-user">Register</button>
                      </div>

                      <p class="text-center text-muted mt-5">Already have an account <a href="{{route('login')}}">Login</a></p>

             </div>
                </form>
            </div>
    </div>
   </div>

@endsection

