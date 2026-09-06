@extends('Layouts.master')

@section('content')
<div class="container auth-page mt-150 mb-150">
    <div class="auth-card">
        <p class="eyebrow">Start your VibeFashion account</p>
        <h1>Create your account</h1>
        <p class="auth-intro">Save your details for faster checkout and keep every accessory order in one place.</p>
        @if ($errors->any())
        <div class="auth-error-summary" role="alert">
            <strong>Please fix the following problems:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('register.store') }}" class="auth-form">
            @csrf
            <div class="row">
                <div class="col-md-6"><label>Full name<input name="name" value="{{ old('name') }}" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Email<input type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Phone<input name="phone" value="{{ old('phone') }}" required>
                        @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Address<input name="address" value="{{ old('address') }}" required>
                        @error('address')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Password
                        <span class="password-field">
                            <input type="password" name="password" required>
                            <button type="button" class="password-toggle" data-password-toggle aria-label="Show password" title="Show password">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>
                        </span>
                        @error('password')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Confirm password
                        <span class="password-field">
                            <input type="password" name="password_confirmation" required>
                            <button type="button" class="password-toggle" data-password-toggle aria-label="Show password" title="Show password">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>
                        </span>
                        @error('password_confirmation')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
            </div>
            <button class="boxed-btn" type="submit">Create account</button>
        </form>
        <p class="auth-switch">Already registered? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
</div>
@endsection