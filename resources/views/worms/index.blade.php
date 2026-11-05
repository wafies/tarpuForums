@extends('layouts.app')

@section('title', 'Kibertārps - Tārpi')

@section('content')
        <div class="section-heading">
            <h1>Atklāj tārpus</h1>
        </div>
    <section class="filter-panel">
        <form action="{{ route('worms.index') }}" method="GET">
            <div class="filter-field">
                <label for="species">Suga</label>

                <select name="species" id="species">
                    @foreach ($wormSpeciesOptions as $value => $label)  
                        <option value="{{ $value }}" @selected($species === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <label for="continent">Kontinents</label>

                <select name="continent" id="continent">
                    @foreach ($continentOptions as $value => $label)  
                        <option value="{{ $value }}" @selected($continent === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <label for="country">Valsts</label>

                <select name="country" id="country">
                    @foreach ($countryOptions as $value => $label)  
                        <option value="{{ $value }}" @selected($country === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <label for="limit">Cik tārpus parādīt? </label>
                <input type="number" name="limit" id="limit" min="1" max="100" value="{{ $limit }}">
                <br>
                <label for="shuffle">Jaukt secību</label>
                <input type="checkbox" name="shuffle" id="shuffle" value="1" @if(request()->query('shuffle')) checked @endif>
            </div>
            
            <div class="filter-buttons">
                <button type="submit" class="button button-primary">Apply</button>

                <a href="{{ route('worms.index') }}" class="button button-secondary">Reset</a>
            </div>
        </form>
    </section>

    <section class="catalogue-section">
        <div class="section-heading">
            @if (!$errorMessage)
                <span class="result-count">{{ count($worms) }} tārpi</span>
            @endif
        </div>
        @if ($errorMessage)
            <div class="message-box error">
                {{ $errorMessage }}
            </div>
        @elseif(empty($worms))
            <div class="message-box">
                No worms found.
            </div>
        @else
            <div class="worms-grid">
                @foreach ($worms as $worm)
                    <div class="worm-card">
                    
                        <div class="worm-card-content">
                            <h2>Nosaukums: {{ $worm['genericName'] ?? 'Untitled Worm' }}</h2>

                            <p class="worm-tag">Zinātniskais nosaukums: {{ $worm['scientificName']}}</p>
                            <p class="worm-tag">Suga: {{ $worm['species'] ?? 'Unknown' }}</p>
                            <p class="worm-tag">Tips: {{ $worm['phylum'] ?? 'Unknown' }}</p>
                            <p class="worm-tag">Kontinents: {{ $worm['continent'] ?? 'Unknown' }}</p>
                            <p class="worm-tag">Valsts: {{ $worm['country'] ?? 'Unknown' }}</p>
                            <p class="worm-tag">Datums: {{ $worm['eventDate'] ?? 'Unknown' }}</p>
                            <p class="worm-tag">Novērotājs: {{ $worm['recordedBy'] ?? 'Unknown' }}</p>
                            @if(!empty($worm['key']))
                                <p class="worm-link">
                                    <a href="https://www.gbif.org/occurrence/{{ $worm['key'] }}" target="_blank">
                                        Skatīt GBIF portālā
                                    </a>
                                </p>
                            @endif
                        </div>
                        <div>
                            @if (!empty($worm['media'][0]['identifier']))
                                <img class="worm-image" src="{{ $worm['media'][0]['identifier'] }}" alt="{{ $worm['genericName'] ?? 'Worm cover' }}" loading="lazy">
                            @else
                                <div class="image-placeholder">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        @endif

    </section>

@endsection