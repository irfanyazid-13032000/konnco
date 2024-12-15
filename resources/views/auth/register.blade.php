@extends('layouts.auth')

@section('title', 'Register - Your Store')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Register</h2>
        <form action="{{route('register.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Register</button>
        </form>
        <p class="auth-link">Already have an account? <a href="{{route('login.index')}}">Login</a></p>
    </div>
</div>
@endsection
