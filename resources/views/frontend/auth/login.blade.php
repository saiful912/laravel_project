@extends('frontend.layouts.master')

@section('main')
    <div class="container">
        <br>
        <p class="text-center mb-5 mt-5 font-weight-bold">Login</p>
        <hr>
        @include('frontend.partials._message')
        <form action="{{route('login')}}" class="form" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" value="{{old('email')}}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Your Password</label>
                <input type="password" name="password"  required class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">
                    Login
                </button>
            </div>

    </div>

@stop