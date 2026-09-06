@extends('Layouts.master')

@section('content')
<div class="container auth-page mt-150 mb-150">
    <div class="auth-card">
        <p class="eyebrow">Your VibeFashion account</p>
        <h1>Profile details</h1>
        <p class="auth-intro">Keep your contact and delivery information up to date.</p>
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
        <form method="POST" action="{{ route('profile.update') }}" class="auth-form">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6"><label>Full name<input name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Email<input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Phone<input name="phone" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
                <div class="col-md-6"><label>Address<input name="address" value="{{ old('address', $user->address) }}" required>
                        @error('address')<span class="field-error">{{ $message }}</span>@enderror
                    </label></div>
            </div>
            <button class="boxed-btn" type="submit">Save changes</button>
        </form>
    </div>
</div>
@endsection