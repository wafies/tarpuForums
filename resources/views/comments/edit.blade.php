@extends('layouts.app')

@section('title', 'Kibertārps - Rediģēt komentāru')

@section('content')
    <div class="form-container">
        <h1>Rediģēt komentāru</h1>

        @include('partials.errors')

        <form
            action="{{ route('comments.update', $comment) }}"
            method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Komentārs</label>

                <textarea
                    id="content"
                    name="content"
                    rows="5"
                    required
                >{{ old('content', $comment->content) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="button">Saglabāt izmaiņas</button>
                <a href="{{ route('comments.index', $comment->post) }}" class="button button-secondary">
                    Atcelt
                </a>
            </div>
        </form>
    </div>
@endsection
