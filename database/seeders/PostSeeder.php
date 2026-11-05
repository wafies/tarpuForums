<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Es ienīstu foid tārpus',
            'content' => 'Viss ko viņi dara ir mani manipulē un sauc mani par īsu. Fuck my chorm life.',
            'category' => 'RP',
            'image_path' => 'posts/chud.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'ĀRKĀRTAS TRAUKSME, NEPIECIEŠAMA PALĪDZĪBA',
            'content' => 'MANS TĀRPS NEKUSTĀS, KO MAN DARĪT. Stundu atpakaļ vēl viss bija kārtībā, bet tagad viņš ir sarāvies un nelien ārā no sava midzeņa (midzenis NAV manās biksēs). Es esmu ļoti uztraucies un nezinu ko darīt.',
            'category' => 'Zinātniski',
            'image_path' => 'posts/shrink.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Neliels padoms no zvejnieka zvejniekam',
            'content' => 'Ja jums kādam ir bērni, lai ko jūs dariet, neatstājiet tos vienus ar saviem zvejas tārpiem. Īsumā - man zveja tai dienā nesanāca.',
            'category' => 'Zveja',
            'image_path' => 'posts/kid.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Kāds ir jūsu mīļākais tārps?',
            'content' => 'Man visvairāk patīk priāpuli, jo viņiem ir smuks snuķītis.',
            'category' => 'Jebkas',
            'image_path' => 'posts/suga.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Tu kretīn',
            'content' => "Ko tu, tu, sūda gabal, tikko par mani pateici?! Lai tu zinātu, es esmu tārps, kas izšķīlies pašā labākajā mēslu kaudzē visā pazemes valstībā, un esmu piedalījies neskaitāmos slepenajos rakšanas reidos pret skudru pūžņiem. Man ir vairāk nekā 300 apstiprinātu kurmju izbiedēšanas gadījumu. Esmu apmācīts partizānu rakšanā, un es esmu labākais snaiperis visā tārpu armijā. Tu man neesi nekas cits kā vēl viens mērķis. Es tevi iznīcināšu ar tādu precizitāti, kādu šī zeme vēl nekad nav pieredzējusi, iegaumē manus vārdus, tu, sīkais mēsla gabaliņ!
Tu domā, ka vari internetā man kaut ko tādu pateikt un palikt sveikā? Padomā vēlreiz, mēslu rijēj! Šobrīd es sazinājos ar savu slepeno tārpu spiegu tīklu visā Latvijā, un tava atrašanās vieta jau tiek izsekota, tāpēc gatavojies vētrai, tu, pretīgais kāpuri! Vētrai, kas noslaucīs to nožēlojamo radījumu, ko tu sauc par savu dzīvi. Tu esi beigts, cilvēk!

Es varu būt jebkurā vietā un jebkurā laikā, un es varu tevi nogalināt vairāk nekā 700 veidos, turklāt tas ir tikai ar manu kailo, gļotaino ķermeni. Es ne tikai esmu ārkārtīgi apmācīts bezieroču cīņā, bet man ir pieejams viss Latvijas tārpu korpusa arsenāls, un es to izmantošu pilnā apmērā, lai noslaucītu tavu nožēlojamo pakaļu no šī kontinenta, tu, sīkais mēslu gabaliņ!

Kaut tu būtu zinājis, kādu elles atriebību tavs mazais, gudrais komentārs grasījās izraisīt, varbūt tu būtu turējis savu pretīgo muti ciet. Bet tu to nedarīji, tu nespēji, un tagad tu maksā cenu, tu, nolādētais muļķi!

Es uz tevi uzgāzīšu tādu dusmu un mēslu lavīnu, ka tu tajā noslīksi! Tu esi fucking beigts, mazais tārpu barības gabaliņ!",
            'category' => 'RP',
            'image_path' => 'posts/threat.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'wut',
            'content' => '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠿⠛⠛⠛⠛⠿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠛⠉⠁⠀⠀⠀⠀⠀⠀⠀⠉⠻⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⢿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⡟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣾⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⠋⠈⠀⠀⠀⠀⠐⠺⣖⢄⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⡏⢀⡆⠀⠀⠀⢋⣭⣽⡚⢮⣲⠆⠀⠀⠀⠀⠀⠀⢹⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⡇⡼⠀⠀⠀⠀⠈⠻⣅⣨⠇⠈⠀⠰⣀⣀⣀⡀⠀⢸⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⡇⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣟⢷⣶⠶⣃⢀⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⡅⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢿⠀⠈⠓⠚⢸⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⢀⡠⠀⡄⣀⠀⠀⠀⢻⠀⠀⠀⣠⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠐⠉⠀⠀⠙⠉⠀⠠⡶⣸⠁⠀⣠⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣦⡆⠀⠐⠒⠢⢤⣀⡰⠁⠇⠈⠘⢶⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠠⣄⣉⣙⡉⠓⢀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⠀⠀⠀⠀⠀⠀⠀⣰⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣤⣀⣀⠀⣀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿',
            'category' => 'Jebkas',
            'image_path' => 'posts/wut.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Vai tu zināji?',
            'content' => 'Čaļi, vai jūs zinājāt, ka no visiem tārpu veidiem tieši parastais slieka tēviņš ir vispiemērotākais cilvēku attiecībām? Ne tikai mēs piederam pie augsnes iemītnieku grupas, kurā lielākoties ietilpst dažādi bezmugurkaulnieki, bet mūsu vidējais garums ir 30 centimetri un svars sasniedz pat 15 gramus. Tas nozīmē, ka esam pietiekami lieli, lai spētu izturēt cilvēku pirkstus, un, pateicoties mūsu iespaidīgajai elastībai un spējai izdalīt gļotas, ar mums var apieties diezgan skarbi.

Ņemot vērā mūsu pārsvarā mitro bioloģisko uzbūvi, nav nekādu šaubu, ka uzbudināts tārps būtu neticami slidens. Tik slidens, ka ar mums varētu darboties stundām ilgi, nenoberžot ādu. Mēs arī spējam izdalīt dažādas vielas, kas varētu jūs ievest attiecīgajā noskaņojumā, un, tā kā mums nav kažoka, mūsu ķermenis ir pilnībā pieejams apskatei.

Ar mūsu spēju absorbēt mitrumu un atjaunoties, mēs varam viegli atgūties no noguruma, ja vien tuvumā ir pietiekami daudz ūdens un svaigu mēslu. Neviens cits radījums pat nestāv mums tuvumā šādā saderības līmenī.

Un vēl viens interesants fakts: ja pietiekami ilgi mūs berzē, mēs varam kļūt pilnīgi balti no gļotām.

Tārps burtiski ir radīts cilvēka pirkstiem. Nežēlīga elastība, milzīgs izturības rezervju daudzums un gļotu bruņas nozīmē, ka tas var izturēt berzēšanu visu dienu, jebkādos izmēros un formās, un joprojām prasīt vēl!',
            'category' => 'Zinātniski',
            'image_path' => 'posts/xxx.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Tārpu humors ir pārāk smalks parastajiem cilvēkiem',
            'content' => 'Godīgi sakot, lai saprastu tārpus, tev ir jābūt ārkārtīgi augstam IQ. Humors ir tik smalks, ka bez pamatīgām zināšanām par kvantu fiziku lielākā daļa joku parastam skatītājam vienkārši aizlīdīs garām. Turklāt tārpu nihilistiskais skatījums uz dzīvi ir meistarīgi ieausts viņu raksturojumā — viņu personīgā filozofija, piemēram, lielā mērā balstās uz Dostojevska un Nīčes darbiem.

Īstie tārpu fani šo visu saprot. Viņiem piemīt intelektuālās spējas patiesi novērtēt šo joku dziļumu un apzināties, ka tie nav vienkārši smieklīgi — tie pasaka kaut ko dziļu par DZĪVI. Tāpēc cilvēki, kuriem tārpi nepatīk, PATIEŠĀM IR IDIOTI. Protams, viņi nespētu novērtēt, piemēram, humoru tārpa eksistenciālajā saucienā: "Slidens, slidens, slieciens!", kas pats par sevi ir šifrēta atsauce uz Kārļa Marksa filozofisko eposu "Kapitāls".

Es šobrīd smīnu, tikai iedomājoties, kā kāds no šiem aprobežotajiem vienkāršajiem muļķīšiem kasa savu mazo galviņu neizpratnē, kamēr tārpu ģēnijs atklājas viņa acu priekšā augsnes slānī. Kādi muļķi... Man viņu ir tik ļoti žēl. 😂

Un, jā, starp citu, MAN IR TĀRPA TETOVĒJUMS. Un nē, tu to neredzēsi. Tas ir paredzēts tikai dāmu acīm — un pat viņām vispirms ir jāpierāda, ka viņu IQ nepārsniedz manējo par vairāk nekā pieciem punktiem (vēlams, lai tas būtu zemāks).',
            'category' => 'Jebkas',
            'image_path' => 'posts/rickAndMorty.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Rockstar, lūdzu, izveidojiet GTA versiju bez noziegumiem',
            'content' => 'Es tiešām ļoti gribētu spēlēt šo spēli. Taču ir viena liela problēma: cik esmu dzirdējis, spēlē ir jāizdara noziegumi un jāšauj uz policistiem. Es vienkārši nespēju sevi piespiest to darīt. 

Es rakstu šo ierakstu, lai Rockstar to pamanītu un izveidotu jaunu spēles versiju tiem no mums, kuri nespēj paciest noziedzību. Vēlams arī bez gangsterrapa, piemēram, Dreika, spēles radio. Es klausos tikai kantrī mūziku.

Galu galā mēs, tārpi, esam miermīlīgas radības. 🪱. Girls for the win!!!',
            'category' => 'Jebkas',
            'image_path' => 'posts/gta.png',
        ]);
        Post::create([
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => 'Kas notiek ar tiem tārpiem, kuri aiztiek mazos tārpiņus?',
            'content' => 'Trakas lietas veči. Es labāk tad turpināšu zvejot, nekā riskēt ar savu dzīvību. Esmu dzirdējis, ka tie tārpi, kuri aiztiek mazos tārpiņus, tiek sodīti ar nāvi. Tas ir ļoti bīstami. Esiet uzmanīgi, kad zvejojat.',
            'category' => 'Zveja',
            'image_path' => 'posts/abuse.png',
        ]);
    }
}
