@extends('layouts.app')

@section('title', 'Aizmirsta paroli')

@section('content')
<div class="form-container">
    <h1>Aizmirsta paroli</h1>

    <p>Ievadiet savu e-pasta adresi, lai pieprasītu paroles atiestatīšanas saiti.</p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <div>
            <label for="email">E-pasts</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <button type="submit">Sūtīt atiestatīšanas saiti</button>
    </form>

    <p>
        <a href="{{ route('login') }}">Atgriezties pieslēgšanās lapā</a>
    </p>
    </div>
@endsection
