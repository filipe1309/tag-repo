@extends('master')

@section('title', 'Login')

@section('content')
    @include('errors', compact('errors'))
    
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" min="1" required class="form-control">
        </div>

        <button class="btn btn-primary mt-3">Enter</button>
        <a href="/register" class="btn btn-secondary mt-3">Register</a>
    </form>
@endsection
