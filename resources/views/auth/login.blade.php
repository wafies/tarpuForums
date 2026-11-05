@extends('layouts.app')

@section('title', 'Pierakstīšanās')

@section('content')
    <div class="form-container">
        <h1>Pierakstīties</h1>

        @include('partials.errors')

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">E-pasts</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Parole</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="button">Pierakstīties</button>
        </form>

        <p class="form-note">
            Nav konta?
            <a href="{{ route('register') }}">Reģistrēties</a>
        </p>
        <p class="form-note">
            Aizmirsāt paroli?
            <a href="{{ route('password.request') }}">Atiestatīt paroli</a>
        </p>
    </div>
@endsection
