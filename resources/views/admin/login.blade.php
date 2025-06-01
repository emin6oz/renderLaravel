@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="mb-4">Admin Login</h3>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required autofocus>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Add Register Button Below Form -->
        <div class="text-center mt-3">
            <a href="{{ route('admin.register.form') }}" class="btn btn-outline-secondary">
                Register as Admin
            </a>
        </div>
    </div>
</div>
@endsection
