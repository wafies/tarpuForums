@extends('layouts.app')

@section('title', 'Kibertārps - Pievienot ierakstu')

@section('content')
    <div class="form-container">
        <h1>Pievienot komentāru</h1>

        @include('partials.errors')

        <form
            action="{{ route('comments.store', $post) }}"
            method="POST"
        >
            @csrf

            <div class="form-group">
                <label for="content">Komentārs</label>

                <textarea
                    id="content"
                    name="content"
                    rows="5"
                    required
                >{{ old('content') }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="button">Publicēt</button>
                <a href="{{ route('comments.index', $post) }}" class="button button-secondary">
                    Atcelt
                </a>
            </div>
        </form>
    </div>
@endsection
