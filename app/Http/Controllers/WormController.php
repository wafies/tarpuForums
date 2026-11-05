<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Illuminate\Support\Str;

class WormController extends Controller
{
    private const API_URL = 'https://api.gbif.org/';

    public function index(Request $request)
    {
        $wormSpeciesOptions = [
            'all' => 'All species',
            42 => 'Annelida',
            5967481 => 'Nematoda',
            108 => 'Platyhelminthes'
        ];
        $continentOptions = [
            'all' => 'All continents',
            'EU' => 'Europe',
            'AFRICA' => 'Africa',
            'ASIA' => 'Asia',
            'NORTH_AMERICA' => 'North America',
            'SOUTH_AMERICA' => 'South America',
            'ANTARCTICA' => 'Antarctica',
            'OCEANIA' => 'Oceania'
        ];
        $countryOptions = [
            'all' => 'All countries',
            'US' => 'United States',
            'CA' => 'Canada',
            'GB' => 'United Kingdom',
            'AU' => 'Australia',
            'DE' => 'Germany',
            'FR' => 'France',
            'IT' => 'Italy',
            'ES' => 'Spain',
            'BR' => 'Brazil',
            'IN' => 'India',
            'LV' => 'Latvia',
            'RU' => 'Russia',
            'CN' => 'China',
            'JP' => 'Japan',
            'ZA' => 'South Africa',
        ];

        $species = $request->query('species', 'all');
        $continent = $request->query('continent', 'all');
        $country = $request->query('country', 'all');
        $limit = $request->query('limit', 20);
        $parameters = [];

        $phylumKey = null;
        foreach ($wormSpeciesOptions as $key => $name) {
            if ($key === 'all') {
                continue;
            }
            if ($name === $species || (string) $key === $species) {
                $phylumKey = $key;
                break;
            }
        }

        if ($phylumKey === null || $phylumKey === 'all') {
            $parameters['phylumKey'] = 42;
        } else {
            $parameters['phylumKey'] = $phylumKey;
        }
        if ($continent !== 'all') {
            $parameters['continent'] = $continent === 'EU' ? 'EUROPE' : $continent;
        }
        if ($country !== 'all') {
            $parameters['country'] = $country;
        }
        $parameters['limit'] = $limit;
        if($query = $request->query('shuffle')) {
            $parameters['shuffle'] = Str::random(8);
        }
        $parameters['mediaType'] = 'StillImage';
        $parameters['occurrenceStatus'] = 'PRESENT';
        $parameters['basisOfRecord'] = 'HUMAN_OBSERVATION';

        $worms = [];
        $errorMessage = null;

        $cacheKey = 'gbif.api'.hash('sha256', json_encode($parameters));

        try {
            $worms = Cache::remember($cacheKey, now()->addHours(1), function () use ($parameters) {
                $response = Http::acceptJson()->timeout(10)->get(self::API_URL.'v1/occurrence/search', $parameters);

                if (! $response->successful()) {
                    throw new RuntimeException(
                        'GBIF returned an unsuccessful response.'
                    );
                }

                $data = $response->json();

                if (! is_array($data) || ! isset($data['results'])) {
                    throw new RuntimeException(
                        'GBIF returned an unexpected response format.'
                    );
                }
                return $data['results'];
            });
        } catch (ConnectionException) {
            $errorMessage = 'The worm catalogue is temporarily unavailable. Please try again later.';
        }

        $selectedFilter = [
            'species' => $species,
            'continent' => $continent,
            'country' => $country,
        ];

        return view('worms.index', compact(
            'worms',
            'errorMessage',
            'wormSpeciesOptions',
            'continentOptions',
            'countryOptions',
            'species',
            'continent',
            'country',
            'limit',
            'selectedFilter'
        ));
    }
}
