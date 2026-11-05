@extends('layouts.app')

@section('title', 'Kibertārps - Lietotāji')

@section('content')
    <div class="page-heading">
        <h1>Lietotāji</h1>
        
    </div>
    <form action="{{route("profile.index")}}" method="get" class="search-form">
        <input type="text" class="search-bar" name="search" placeholder="Meklējiet lietotāju pēc tā vārda">
        <button type="submit" class="search-btn button">🔍</button> 
        <a href="{{route("profile.index")}}" class="button">Clear</a>
    </form>
    @if ($users->isEmpty())
    <div class="empty-users">
        <p class="empty-message">Nav lietotāju??? :(</p>
    </div>
    @else
        <div class="user-grid">
            @foreach ($users as $user)
            <div class="user">
                <div class="user-bar">
                    @if ($user->profile_picture)
                        <img
                            src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="{{ $user->name }}"
                            class="post-profile-picture"
                            loading="lazy"
                        >
                    @else
                    <div class="profile-placeholder-post">
                        <span class="profile-letter-post">{{$user->name[0]}}</span>
                    </div>
                    @endif
                    <p class="user-name">
                        {{ $user->name }}
                    </p>
                    <div class="user-actions">
                        <a
                            href="{{ route('profile.specific', $user) }}"
                            class="button button-small">
                            Apskatīt pilno profilu
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            @if($users->hasPages())
            <button class="pagination-button" id="prevPage" {{ $users->onFirstPage() ? 'disabled' : '' }}>
                <a href="{{ $users->previousPageUrl() }}" class="pagination-link">Iepriekšējā lapa</a>
            </button>
            <span class="pagination-info">Lapa {{ $users->currentPage() }} no {{ $users->lastPage() }}</span>
            <button class="pagination-button" id="nextPage" {{ $users->hasMorePages() ? '' : 'disabled' }}>
                <a href="{{ $users->nextPageUrl() }}" class="pagination-link">Nākamā lapa</a>
            </button>
            @else
            <span class="pagination-info">Nav vairāk lapu</span>
            @endif
        </div>
    @endif
@endsection
