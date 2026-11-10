@extends('layouts.app')

@section('title', 'Kibertārps - Lietotājs')

@section('content')
    <div class="page-heading">
        <h1>Lietotājs</h1>
        
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
                        <p>Publikācijas: 0</p>
                    @else
                        <p>Publikācijas: {{$user->posts->count()}}</p>
                        @foreach($user->posts as $post)
                            <a href="{{route('comments.index', $post)}}" class="user-post-link">{{$post->title}}</a>
                        @endforeach
                    @endif
                    @can('delete', $user)
                    <form method="post" onsubmit="return confirm('Vai jūs tiešām vēlaties dzēst savu profilu? Šī darbība ir neatgriezeniska');" action="{{route('profile.destroy', $user)}}">
                        @csrf
                        @method('DELETE')
                        <input type='hidden' name="check"> <!-- there probably is a better way but whatever -->
                        <button type="submit" class="button danger">Dzēst profilu</button>
                    </form>
                    @endcan
            </div>
        </div>
@endsection
