@extends('layouts.auth')

@section('title', 'Login - Yazid Store')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Login</h2>
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="auth-link">Don't have an account? <a href="{{route('register')}}">Register</a></p>
    </div>
</div>
@endsection
