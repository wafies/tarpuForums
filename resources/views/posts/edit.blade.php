@extends('layouts.app')

@section('title', 'Kibertārps - Rediģēt ierakstu')

@section('content')
    <div class="form-container">
        <h1>Rediģēt ierakstu</h1>

        @include('partials.errors')

        <div class="edit-image">
            <p>Pašreizējā bilde</p>

            <img
                src="{{ asset('storage/' . $post->image_path) }}"
                alt="{{ $post->title }}"
            >
        </div>

        <form
            action="{{ route('posts.update', $post) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Virsraksts</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    maxlength="255"
                    required
                >
            </div>

            <div class="form-group">
                <label for="content">Ieraksta saturs</label>

                <textarea
                    id="content"
                    name="content"
                    rows="5"
                    required
                >{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Kategorija</label>
                <select name="category" id="category">
                    <option value="Dārzniecība" {{ old('category', $post->category) == 'Dārzniecība' ? 'selected' : '' }}>Dārzniecība</option>
                    <option value="Zveja" {{ old('category', $post->category) == 'Zveja' ? 'selected' : '' }}>Zveja</option>
                    <option value="Zinātniski" {{ old('category', $post->category) == 'Zinātniski' ? 'selected' : '' }}>Zinātniski</option>
                    <option value="RP" {{ old('category', $post->category) == 'RP' ? 'selected' : '' }}>RP</option>
                    <option value="Jebkas" {{ old('category', $post->category) == 'Jebkas' ? 'selected' : '' }}>Jebkas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Aizvietot bildi (neobligāti)</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                >

                <p class="help-text">Atstājiet tukšu lai paliktu tagadējā bilde.</p>
            </div>

            <div class="form-actions">
                <button type="submit" class="button">Saglabāt izmaiņas</button>
                <a href="{{ route('posts.index') }}" class="button button-secondary">
                    Atcelt
                </a>
            </div>
        </form>
    </div>
@endsection
