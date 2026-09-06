@extends('Layouts.master')

@section('content')
<div class="container auth-page mt-150 mb-150">
    <div class="auth-card auth-card-small">
        <p class="eyebrow">Welcome back</p>
        <h1>Sign in to VibeFashion</h1>
        <p class="auth-intro">Continue to your saved cart and order history.</p>
        @if ($errors->any())
        <div class="auth-error-summary" role="alert">
            <strong>Unable to sign in.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('login.store') }}" class="auth-form">
            @csrf
            <label>Email<input type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Password
                <span class="password-field">
                    <input type="password" name="password" required>
                    <button type="button" class="password-toggle" data-password-toggle aria-label="Show password" title="Show password">
                        <i class="fas fa-eye" aria-hidden="true"></i>
                    </button>
                </span>
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="checkbox-label"><input type="checkbox" name="remember" value="1"> Remember me</label>
            <button class="boxed-btn" type="submit">Sign in</button>
        </form>
        <p class="auth-switch">New to VibeFashion? <a href="{{ route('register') }}">Create an account</a></p>
    </div>
</div>
@endsection