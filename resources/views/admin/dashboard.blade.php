@extends('layouts.app')

@section('title', 'Kibertārps - Admin')

@section('content')
    <div class="form-container">
        <h1>Administratora panelis</h1>

        <p>Sveiki, {{ auth()->user()->name }}.</p>

        <p>
            Tava loma ir <strong>{{ auth()->user()->role }}</strong>.
            Administratori var dzēst un rediģēt visus ierakstus.
        </p>

        <p>
            Forumā ir <strong>{{ $userCount }}</strong> reģistrēti lietotāji, <strong>{{ $postCount }}</strong> ieraksti un <strong>{{ $commentCount }}</strong> komentāri.
        </p>
        <a href="{{ route('comments.index', $latestPost) }}">
            Jaunākais ieraksts: <strong>{{ $latestPost->title }}</strong> ({{ $latestPost->created_at->format('d.m.Y H:i') }})
        </a>
        <a href="{{ route('profile.specific', $latestUser) }}">
            Jaunākais lietotājs: <strong>{{ $latestUser->name }}</strong> (Reģistrēts: {{ $latestUser->created_at->format('d.m.Y H:i') }})
        </a>
        <a href="{{ route('comments.index', $latestComment->post) }}">
            Jaunākais komentārs: <strong>{{ $latestComment->content }}</strong> ({{ $latestComment->created_at->format('d.m.Y H:i') }})
        </a>
        <h2>Ziņojumi par rakstiem</h2>
        @foreach ($reports as $report)
        <div class="reportContainer">
            <a href="{{ route('comments.index', $report->post) }}">
                Ziņojums par ierakstu: <strong>{{ $report->post->title }}</strong> (Ziņots: {{ $report->created_at->format('d.m.Y H:i') }})
            </a>
            <p>Ziņojuma saturs: <strong>{{ $report->reason }}</strong></p>
            <form method='post' action='{{route('reports.destroy', $report)}}'>
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Dzēst ziņojumu (NEVIS IERAKSTU, EJ PATS TO DARI)</button>
            </form>
        </div>
        @endforeach
        <a href="{{ route('posts.index') }}" class="button">
            Atgriezties forumā
        </a>
    </div>
@endsection
