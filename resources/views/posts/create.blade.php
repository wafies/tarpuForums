@extends('layouts.app')

@section('title', 'Kibertārps - Pievienot ierakstu')

@section('content')
    <div class="form-container">
        <h1>Pievienot ierakstu</h1>

        @include('partials.errors')

        <form
            action="{{ route('posts.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group">
                <label for="title">Virsraksts</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
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
                >{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Kategorija</label>
                <select name="category" id="category">
                    <option value="Dārzniecība">Dārzniecība</option>
                    <option value="Zveja">Zveja</option>
                    <option value="Zinātniski">Zinātniski</option>
                    <option value="RP">RP</option>
                    <option value="Jebkas">Jebkas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Bilde</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                    required
                >

                <p class="help-text">Maksimālais faila izmērs: 2 MB.</p>
            </div>

            <div class="form-actions">
                <button type="submit" class="button">Publicēt</button>
                <a href="{{ route('posts.index') }}" class="button button-secondary">
                    Atcelt
                </a>
            </div>
        </form>
    </div>
@endsection
