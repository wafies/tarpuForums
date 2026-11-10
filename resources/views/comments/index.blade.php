@extends('layouts.app')

@section('title', 'Kibertārps - Komentāri')

@section('content')
    <div class="post-author-bar">
            @if ($post->user->profile_picture)
                <img
                    src="{{ asset('storage/' . $post->user->profile_picture) }}"
                    alt="{{ $post->user->name }}"
                    class="post-profile-picture"
                    loading="lazy"
                >
            @else
            <div class="profile-placeholder-post">
                <span class="profile-letter-post">{{$post->user->name[0]}}</span>
            </div>
            @endif
            <a href="{{route('profile.specific', $post->user)}}" class="post-author">
                {{ $post->user->name }}
            </a>
            <p class="post-date">
                {{ $post->created_at->format('d.m.Y') }}
            </p>
        </div>
        <article class="post-card">
            <img
                src="{{ asset('storage/' . $post->image_path) }}"
                alt="{{ $post->title }}"
                class="post-image"
                loading="lazy"
            >

            <div class="post-content">
                <h2>{{ $post->title }}</h2>
                <p class="post-content">{{ $post->content }}</p>
            </div>
            
        </article>
        <div class="comment-action-container">
        <div class="comment-actions">
            <a href="{{ route('comments.create', $post) }}" class="button commentBtn">
                Pievienot komentāru
            </a>
            @auth
                <form action="{{ route('posts.like', $post) }}" method="POST">
                    @csrf
                    @method('post')
                    <button type="submit" class="button like" id="{{ ($post->likes()->where('user_id', auth()->id())->exists()) ? 'liked' : '' }}">
                        🪱 {{$post->likes->count() }}
                    </button>
                </form>
            @else
                <button disabled type="submit" class="disabled button like">
                    🪱 {{$post->likes->count() }}
                </button>
            @endauth
            @auth
                @if(!$post->reports()->where('user_id', auth()->id())->exists()) <!-- if already reported -->
                <form action="{{ route('posts.report', $post) }}" method="POST" id="post-{{ $post->id }}-reportForm">
                    @csrf
                    <button onclick="showReportForm('post-{{ $post->id }}')" type="submit" class="button report" id="{{ ($post->reports()->where('user_id', auth()->id())->exists()) ? 'reported' : ''}}">
                        🚩
                    </button>
                </form>
                @else
                    <button disabled type="submit" class="disabled button report" id="reported">
                        🚩
                    </button>
                @endif
            @else
                <button disabled type="submit" class="disabled button report">
                    🚩
                </button>
            @endauth
            @can('update', $post)
                <a
                    href="{{ route('posts.edit', $post) }}"
                    class="button commentBtn"
                >
                    Rediģēt
                </a>
            @endcan

            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="button button-delete"
                    >
                        Dzēst
                    </button>
                </form>
            @endcan
        </div>
    @if ($comments->isEmpty())
        <div class="comment">
            <p class="empty-message">Nav komentāru :(</p>
        </div>
    @else
        <form action="{{ route('comments.index', $post) }}" method="get" class="comment-sort-form">
            <div class="form-group">
                <label for="sort">Kārtot pēc</label>
                <select name="sort" id="sort" class='comment-sort'>
                    <option value="newest" @if($sort === 'newest') selected @endif>Jaunākie</option>
                    <option value="oldest" @if($sort === 'oldest') selected @endif>Vecākie</option>
                    <option value="most_liked" @if($sort === 'most_liked') selected @endif>Visvairāk patiktie</option>
                    <option value="least_liked" @if($sort === 'least_liked') selected @endif>Vismazāk patiktie</option>
                </select>
                <button type="submit" class="button">Kārtot</button>
            </div>
        </form>
        </div>
        <div class="comment-grid">
            @foreach ($comments as $comment)
                <div class="comment">
                    <div class="comment-author-bar">
                        @if($comment->user->profile_picture)
                        <img
                            src="{{ asset('storage/' . $comment->user->profile_picture) }}"
                            alt="{{ $comment->user->name }}"
                            class="comment-profile-picture"
                            loading="lazy"
                        >
                        @else
                        <div class="profile-placeholder-post">
                            <span class="profile-letter-post">{{$comment->user->name[0]}}</span>
                        </div>
                        @endif
                        <a href="{{route('profile.specific', $comment->user)}}" class="comment-author">{{$comment->user->name}}</a>
                        <p class="comment-date">
                            {{ $comment->created_at->format('d.m.Y H:i') }}
                        </p>
                    </div>
                    <div class="comment-content">
                        <p class="comment-content">{{$comment->content}}</p>
                    </div>
                    <div class="comment-actions">
                        @auth
                            <form action="{{ route('comments.like', $comment) }}" method="POST">
                                @csrf
                                <button type="submit" class="button like" id="{{ $comment->liked_by_user ? 'liked' : '' }}">
                                    🪱 {{ $comment->likes_count }}
                                </button>
                            </form>
                        @else
                            <button disabled type="submit" class="disabled button like">
                                🪱 {{ $comment->likes_count }}
                            </button>
                        @endauth
                        @auth
                            @if(!$comment->reported_by_user)
                            <form action="{{ route('comments.report', $comment) }}" method="POST" id="comment-{{ $comment->id }}-reportForm">
                                @csrf
                                <button onclick="showReportForm('comment-{{ $comment->id }}')" type="submit" class="button report">
                                    🚩
                                </button>
                            </form>
                            @else
                            <button disabled type="submit" class="disabled button report" id="reported">
                                🚩
                            </button>
                            @endif
                        @else
                            <button disabled type="submit" class="disabled button report">
                                🚩
                            </button>
                        @endauth
                        @can('update', $comment)
                            <a href="{{ route('comments.edit', $comment) }}" class="button commentBtn button-small">
                                Rediģēt
                            </a>
                        @endcan

                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button commentBtn button-delete">
                                    Dzēst
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            @if($comments->hasPages())
            <a href="{{ $comments->previousPageUrl() }}" class="pagination-link button {{ $comments->onFirstPage() ? 'disabled' : '' }}">Iepriekšējā lapa</a>
            <span class="pagination-info">Lapa {{ $comments->currentPage() }} no {{ $comments->lastPage() }}</span>
            <a href="{{ $comments->nextPageUrl() }}" class="pagination-link button {{ $comments->hasMorePages() ? '' : 'disabled' }}">Nākamā lapa</a>
            @else
            <span class="pagination-info">Nav vairāk lapu</span>
            @endif
        </div>
    @endif
        <a href="{{route('posts.index')}}" class="button">Atpakaļ</a>

@endsection
