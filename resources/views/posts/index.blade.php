@extends('layouts.app')

@section('title', 'Kibertārps - Forums')

@section('content')
    <div class="page-heading">
        <h1>Forums</h1>
        
    </div>

    @if ($posts->isEmpty())
    <div class="empty-post">
        <p class="empty-message">Nav publikāciju :(</p>
    </div>
    @else
        <div class="post-grid">
            @foreach ($posts as $post)
            <div class="post">
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
                        <a class="post-author" href="{{route('profile.specific', $post->user)}}">
                            {{ $post->user->name }}
                        </a>
                        <p class="post-date">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                        <div class="category-badge">
                            <span>{{$post->category}}</span>
                        </div>
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
                        @if(!$post->comments->isEmpty())
                        <p>Jaunākie komentāri: </p>
                        <div class="latest-comments">
                            @foreach($post->comments()->with('user')->latest()->limit(3)->get() as $comment)
                            <div class="comment">
                            <div class="comment-author-bar">
                            @if($comment->user->profile_picture)
                            <img
                                src="{{ asset('storage/' . $comment->user->profile_picture) }}"
                                alt="{{ $post->title }}"
                                class="comment-profile-picture"
                                loading="lazy"
                            >
                            @else
                            <div class="profile-placeholder-post">
                                <span class="profile-letter-post">{{$comment->user->name[0]}}</span>
                            </div>
                            @endif
                            <a class="comment-author" href="{{route('profile.specific', $comment->user)}}">
                                {{$comment->user->name}}
                            </a>
                            <span class="comment-date">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                            <span class="comment-likes">
                                🪱 {{$comment->likes->count() }}
                            </span>
                            </div>
                                <p class="comment-content">{{$comment->content}}</p>
                            </div>
                            @endforeach
                        </div>
                            @else
                            <p>Nav komentāru :(</p>
                            @endif
                        <div class="post-actions">
                        @auth
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            @method('post')
                            <button type="submit" class="button like" id="{{ ($post->likes()->where('user_id', auth()->id())->exists()) ? 'liked' : ''}}">
                                🪱 {{$post->likes->count() }}
                            </button>
                        </form>
                        @else
                            <button disabled type="submit" class="disabled button like">
                                🪱 {{$post->likes->count() }}
                            </button>
                        @endauth
                        @auth
                            @if(!$post->reports()->where('user_id', auth()->id())->exists())
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
                            <a
                                href="{{ route('comments.index', $post) }}"
                                class="button commentBtn">
                                Apskatīt visus komentārus
                            </a>
                        </div>
                    </div>
                </article>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            @if($posts->hasPages())
            <button class="pagination-button {{ $posts->onFirstPage() ? 'disabled' : '' }}" id="prevPage">
                <a href="{{ $posts->previousPageUrl() }}" class="pagination-link">Iepriekšējā lapa</a>
            </button>
            <span class="pagination-info">Lapa {{ $posts->currentPage() }} no {{ $posts->lastPage() }}</span>
            <button class="pagination-button {{ $posts->hasMorePages() ? '' : 'disabled' }}" id="nextPage">
                <a href="{{ $posts->nextPageUrl() }}" class="pagination-link" >Nākamā lapa</a>
            </button>
            @else
            <span class="pagination-info">Nav vairāk lapu</span>
            @endif
        </div>
    @endif
@endsection
