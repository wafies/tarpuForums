<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jānītis',
            'email' => 'a@a',
            'password' => Hash::make('password'),
            'description' => 'Es esmu tārps, kas dzīvo zem zemes. Man patīk ēst zemi un rakņāties pa to. Es esmu ļoti draudzīgs un vienmēr gatavs palīdzēt citiem tārpiem.',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Anna',
            'email' => 'b@b',
            'password' => Hash::make('password'),
            'description' => 'Tārpu entuziasts. Es esmu ļoti aizrautīgs par tārpiem un viņu dzīvi. Es bieži rakstu par tārpiem un dalos ar saviem pētījumiem.',
        ]);
        User::create([
            'name' => 'Juris',
            'email' => 'c@c',
            'password' => Hash::make('password'),
            'description' => 'Īsts latvietis šeit. Ja tu esi liberālis vai kreisais, tad tu esi mans ienaidnieks. Progresīvie ir jāiznīcina, lai saglabātu mūsu kultūru un tradīcijas. Es esmu gatavs cīnīties par mūsu nākotni.',
        ]);
        User::create([
            'name' => 'Līga',
            'email' => 'd@d',
            'password' => Hash::make('password'),
            'description' => 'Rietumu ala ir kritusi draugi.',
        ]);
        User::create([
            'name' => 'Mārtiņš',
            'email' => 'e@e',
            'password' => Hash::make('password'),
            'description' => 'Zinātnieks. Veicu pētijumus garāžā.',
        ]);
    }
}
