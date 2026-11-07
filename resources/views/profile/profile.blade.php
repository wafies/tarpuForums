@extends('layouts.app')

@section('title', 'Kibertārps - Profils')

@section('content')
    <div class="page-heading">
        <h1>Jūsu profils</h1>
    </div>
        <div class="user">
            <div class="user-container">
                    @if ($user->profile_picture)
                        <img
                            src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="{{ $user->name }}"
                            class="user-profile-specific"
                            loading="lazy"
                        >
                    @else
                        <div class="profile-placeholder">
                            <span class="profile-letter">{{$user->name[0]}}</span>
                        </div>
                    @endif
                    <p class="user-name-specific">
                        {{ $user->name }}
                    </p>
                    <p class="user-description-specific">Apraksts: {{$user->description}}</p>
                    <p>Reģistrējies: {{$user->created_at->format('d.m.Y H:i')}}</p>
                    @if($user->posts->isEmpty())
                        <h2>Publikācijas: 0</h2>
                    @else
                        <h2>Publikācijas: {{$user->posts->count()}}</h2>
                        @foreach($user->posts as $post)
                            <a href="{{route('comments.index', $post)}}" class="user-post-link">{{$post->title}}</a>
                        @endforeach
                    @endif
                            <div class="liked-posts">
            <h2>Patiktie ieraksti:</h2>
            @if($likedPosts->isEmpty())
                <p>Jums vēl nav patikuši ieraksti.</p>
            @else
                <ul>
                    @foreach($likedPosts as $post)
                        <li>
                            <a href="{{ route('comments.index', $post) }}">{{ $post->title }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
            </div>
        </div>
    <div class="form-container profile-container">
        @include('partials.errors')
        <h2>Vārds: {{$user->name}}</h2>
        <form action="{{route('profile.updateName')}}" method="post" class="profile-form">
            @csrf
            @method('put')
            <label for="nameChange">Mainīt vārdu: </label>
            <input type="text" name="name" id="nameChange">
            <button type="submit">Mainīt</button>
        </form>
        <h2>Apraksts: </h2><span>{{$user->description}}</span>
        <form action="{{route('profile.updateDesc')}}" method="post" class="profile-form">
            @csrf
            @method('put')
            <label for="descChange">Mainīt savu aprakstu: </label>
            <textarea name="description" id="descChange"></textarea>
            <button type="submit">Mainīt</button>
        </form>
        <h2>Profila bilde: </h2>
        @if ($user->profile_picture)
            <img
                src="{{ asset('storage/' . $user->profile_picture) }}"
                alt="{{ $user->name }}"
                class="profile-picture"
                loading="lazy"
            >
        @else
            <p>Jums vēl nav profila bildes.</p>
        @endif

        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('put')

        <label for="profile_picture">Rediģēt savu bildi: </label>
            <input
                type="file"
                id="profile_picture"
                name="profile_picture"
                accept="image/*"
                required
            >

        <button type="submit">Rediģēt</button>
        </form>
        <a href="{{route('posts.index')}}" class="button">Atpakaļ</a>
    </div>
@endsection
