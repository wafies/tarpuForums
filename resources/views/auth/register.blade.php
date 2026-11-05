@extends('layouts.app')

@section('title', 'Reģistrēšanās')

@section('content')
    <div class="form-container">
        <h1>Reģistrēties</h1>

        @include('partials.errors')

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Vārds</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                >
            </div>

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
                    autocomplete="new-password"
                    required
                >

                <p class="help-text">
                    Vismāk 8 rakstzīmes, iekļaujot lielo burtu, mazo burtu un ciparu.
                </p>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Apstiprināt paroli</label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="button">Reģistrēties</button>
        </form>

        <p class="form-note">
            Jau esat reģistrējies?
            <a href="{{ route('login') }}">Pierakstīties</a>
        </p>
    </div>
@endsection
