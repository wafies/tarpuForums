@extends('layouts.app')

@section('title', 'Aizmirsta paroli')

@section('content')
<div class="form-container">
    <h1>Atiestatīt paroli</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >

        <div>
            <label for="email">E-pasts</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $email) }}"
                readonly
                required
            >
        </div>

        <div>
            <label for="password">Jauna parole</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="new-password"
                required
            >
        </div>

        <div>
            <label for="password_confirmation">Apstiprināt jaunu paroli</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                required
            >
        </div>

        <button type="submit">Atiestatīt paroli</button>
    </form>
    </div>
@endsection