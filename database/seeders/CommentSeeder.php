<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'post_id' => 1,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Man nav bijis fārps jau 20 gadus. Es esmu ledus ciets tārpcels.',
        ]);
        Comment::create([
            'post_id' => 1,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Tu vienkārši esi neglīts, laiks tārpmaxxot, akmeņmaxxot un gļotmaxxot vecīt.',
        ]);
        Comment::create([
            'post_id' => 1,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'KO tu teici par sieviešu dzimtas tārpu pārstāvjiem?!??!?!?! Tu tiksi iznicināts draudziņ. Es esmu speciālās tārpu uzdevumu vienības līderis. Man ir 200 apstiprinātu putnu līķu. Tu pat nepaspēsi sadalīties pirms es tevi iznīcināšu. Vēro ko tu saki, kretīntārp.',
        ]);
        Comment::create([
            'post_id' => 1,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Es dodos apšaut ebreju alu (tārpkraftā, protams)',
        ]);
        Comment::create([
            'post_id' => 2,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Pamēģini sadalīt viņu uz pusēm',
        ]);
        Comment::create([
            'post_id' => 2,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Man ir viens paziņa kas tirgo tabletes, lai tārps izaugtu 10cm lielāks un noturētos tāds. Dod ziņu.',
        ]);
        Comment::create([
            'post_id' => 2,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Aizvāc to pretekli. Tu nepiedienīgā cērme',
        ]);
        Comment::create([
            'post_id' => 3,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Kāpēc tev rokās ir josta?',
        ]);
        Comment::create([
            'post_id' => 3,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Es tavā vietā viņam neļautu ar to tikt cauri sveikā, just sayin.',
        ]);
        Comment::create([
            'post_id' => 4,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Tu larpo tu jobanā dēle. Es ienīstu cilvēkus kā tu, jūs izbojājat šo hobiju visiem īstajiem tārpu faniem.',
        ]);

$comments = [
    // POST 1 - Es ienīstu foid tārpus
    [1, 'Foid tārpiem nav dvēseles.'],
    [1, 'Brāli, vienkārši sāc tārpmaxxot. 3 mēneši mitrā augsnē un tu būsi cits radījums.'],
    [1, 'Kāds vispār ir tavs garums? Varbūt problēma nav foidos, bet tavā diametrā.'],
    [1, 'Es pazīstu vienu tārpu, kas varētu tev palīdzēt. Viņš dzīvo pie trešās kanalizācijas akas.'],
    [1, 'Šis ir klasisks tārpu sabiedrības sabrukuma piemērs.'],
    [1, 'Foid detected. Opinion rejected.'],
    [1, 'Man nav bijis fārps kopš 2006. gada. Esmu sasniedzis augstāko apziņas līmeni.'],
    [1, 'Kāpēc tu vispār runā ar viņiem? Es savu laiku pavadu tikai ar sliekām, kurām ir vismaz 12 cm.'],

    // POST 2 - Tārps nekustās
    [2, 'Brāli viņš vienkārši AFK.'],
    [2, 'Pamēģini viņu uzlādēt.'],
    [2, 'Iespējams, ka viņš ir sasniedzis ziemas miega fāzi. Neaiztiec.'],
    [2, 'Vai esi pārbaudījis viņa temperatūru?'],
    [2, 'Mans tārps arī tā dara, kad es viņam parādu elektrības rēķinu.'],
    [2, 'RIP mazais karavīrs. Viņš bija pārāk labs šai pasaulei.'],
    [2, 'Pārbaudi, vai nav aizgājis uz citu midzeni.'],
    [2, 'Ieslēdz viņam kādu Hans Zimmer mūziku. Varbūt atgriezīsies motivācija.'],

    // POST 3 - Zvejnieks zvejniekam
    [3, 'Kāpēc tev rokās ir josta?'],
    [3, 'Tārps vai bērns, abi ir lieliska ēsma.'],
    [3, 'Es tavā vietā pārbaudītu arī pārējos zvejas piederumus.'],
    [3, 'Šī iemesla dēļ es savus tārpus glabāju seifā.'],
    [3, 'Brāli, man vajag kontekstu.'],
    [3, 'Makšķerēšana Latvijā nekad vairs nebūs tāda pati.'],
    [3, 'Tāpēc man patīk ķert zivis bez ēsmas. Mazāk juridisku problēmu.'],

    // POST 4 - Mīļākais tārps
    [4, 'Priāpuli izskatās pēc priekšādiņas ar ambīcijām.'],
    [4, 'Man patīk planārijas. Viņas ir praktiski nemirstīgas. Relatable.'],
    [4, 'Lielākais Latvijas tārps ir tas, kas dzīvo manā pagrabā un maksā īri.'],
    [4, 'Slieka. Klasika. Nevajag sarežģīt vienkāršas lietas.'],
    [4, 'Es balsoju par nematodēm. Mazas, bet ar lielu potenciālu.'],
    [4, 'Kāds te vispār ir redzējis dzīvu priāpuli? Es domāju, ka viņi ir valdības izdomājums.'],
    [4, 'Dēles ir underrated. Viņas vismaz prot pieķerties savam mērķim.'],

    // POST 5 - Tārpu Navy Seal copypasta
    [5, 'Es šo izlasīju savam tārpam priekšā. Viņš tagad dienē armijā.'],
    [5, 'Tu aizmirsi pieminēt 400 apstiprinātās kurmju slepkavības.'],
    [5, 'Brāli, tu esi 2 cm garš. Nomierinies.'],
    [5, 'Man ir onkulis, kurš strādā Tārpu specvienībā. Viņš saka, ka tu esi mīksts.'],
    [5, 'Es tikko izsaucu kurmju policiju. Tavs midzenis ir aplenkts.'],
    [5, 'Kāpēc šis ir tik labi uzrakstīts?'],
    [5, 'Average slieka pēc 3 enerģijas dzērieniem.'],
    [5, 'Mēslu kaudzes veterāns. Respect.'],
    [5, 'Es esmu redzējis, kā tu bēdz no lietus. Tu neesi nekāds snaiperis.'],

    // POST 6 - wut
    [6, 'Es redzu.'],
    [6, 'Neredzu.'],
    [6, 'Šis attēls man atņēma 4 cm no mana garuma.'],
    [6, 'Tas ir mans tēvs. Lūdzu izdzēs.'],
    [6, 'Kāpēc viņš izskatās pēc pašvaldības darbinieka?'],
    [6, 'Visu cieņu, bet šis ir labākais posts šajā forumā.'],
    [6, 'Bro is NOT soilmaxxing.'],
    [6, 'Man dators sāka smirdēt pēc mitras zemes.'],

    // POST 7 - Vaporeon copypasta
    [7, 'Es zvēru, ka šim forumam vajag moderatorus.'],
    [7, 'Kā biologs varu apstiprināt, ka šis nav bioloģijas jautājums.'],
    [7, 'Brāli, izslēdz internetu un aizej pieskarties augsnei.'],
    [7, 'Man bija normāla diena, līdz es izlasīju šo.'],
    [7, 'Viss, ko es gribēju, bija uzzināt par tārpiem.'],
    [7, 'Admini, lūdzu, pievienojiet iespēju bloķēt konkrētus cilvēkus.'],
    [7, 'Šis ir iemesls, kāpēc tārpiem nav piešķirtas cilvēktiesības.'],
    [7, 'Es izsaucu tārpu policiju.'],

    // POST 8 - Rick and Morty IQ
    [8, 'Man ir 147 IQ un es šo nesapratu.'],
    [8, 'Nīče raudētu, ja redzētu šo forumu.'],
    [8, 'Patiesībā tārpu nihilisms ir ļoti interesanta filozofiska tēma.'],
    [8, 'Brāli, tu esi lasījis vienu Vikipēdijas rakstu un tagad domā, ka esi Dostojevskis.'],
    [8, 'Wubba Lubba Dub Dub nozīmē, ka man vajag vairāk mēslu.'],
    [8, 'Tārpu tetovējums ir uz tava dzimumlocekļa, vai ne?'],

    // POST 9 - GTA bez noziedzības
    [9, 'Es gribētu GTA, kurā tu vienkārši strādā par kurjeru un maksā nodokļus.'],
    [9, 'Beidzot kāds normāls tārps.'],
    [9, 'Es gribu GTA 6, bet lai galvenais varonis ir slieka, kas cenšas nopirkt māju Rīgā.'],
    [9, 'Country radio vienīgais pareizais viedoklis.'],
    [9, 'Es gribētu spēli, kurā tu vari 8 stundas rakt tuneli un tad nomirt no traktora.'],
    [9, 'Rockstar, lūdzu, pievienojiet iespēju kļūt par kompostētāju.'],
    [9, 'Manuprāt, policistu šaušana ir slikta, bet kurmju šaušana ir pieņemama.'],
    [9, 'GTA: Gardening Theft Auto.'],
];

foreach ($comments as [$postId, $content]) {
    Comment::create([
        'post_id' => $postId,
        'user_id' => User::inRandomOrder()->first()?->id,
        'content' => $content,
    ]);
}

    }
}
