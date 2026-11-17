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
            'post_id' => 4,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Kāpēc tev rokās ir josta?',
        ]);
        Comment::create([
            'post_id' => 4,
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => 'Es tavā vietā viņam neļautu ar to tikt cauri sveikā, just sayin.',
        ]);
        Comment::create([
            'post_id' => 5,
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
    

    // POST 4 - Zvejnieks zvejniekam
    [4, 'Kāpēc tev rokās ir josta?'],
    [4, 'Tārps vai bērns, abi ir lieliska ēsma.'],
    [4, 'Es tavā vietā pārbaudītu arī pārējos zvejas piederumus.'],
    [4, 'Šī iemesla dēļ es savus tārpus glabāju seifā.'],
    [4, 'Brāli, man vajag kontekstu.'],
    [4, 'Makšķerēšana Latvijā nekad vairs nebūs tāda pati.'],
    [4, 'Tāpēc man patīk ķert zivis bez ēsmas. Mazāk juridisku problēmu.'],

    // POST 5 - Mīļākais tārps
    [5, 'Priāpuli izskatās pēc priekšādiņas ar ambīcijām.'],
    [5, 'Man patīk planārijas. Viņas ir praktiski nemirstīgas. Relatable.'],
    [5, 'Lielākais Latvijas tārps ir tas, kas dzīvo manā pagrabā un maksā īri.'],
    [5, 'Slieka. Klasika. Nevajag sarežģīt vienkāršas lietas.'],
    [5, 'Es balsoju par nematodēm. Mazas, bet ar lielu potenciālu.'],
    [5, 'Kāds te vispār ir redzējis dzīvu priāpuli? Es domāju, ka viņi ir valdības izdomājums.'],
    [5, 'Dēles ir underrated. Viņas vismaz prot pieķerties savam mērķim.'],

    // POST 6 - Tārpu Navy Seal copypasta
    [6, 'Es šo izlasīju savam tārpam priekšā. Viņš tagad dienē armijā.'],
    [6, 'Tu aizmirsi pieminēt 400 apstiprinātās kurmju slepkavības.'],
    [6, 'Brāli, tu esi 2 cm garš. Nomierinies.'],
    [6, 'Man ir onkulis, kurš strādā Tārpu specvienībā. Viņš saka, ka tu esi mīksts.'],
    [6, 'Es tikko izsaucu kurmju policiju. Tavs midzenis ir aplenkts.'],
    [6, 'Kāpēc šis ir tik labi uzrakstīts?'],
    [6, 'Average slieka pēc 3 enerģijas dzērieniem.'],
    [6, 'Mēslu kaudzes veterāns. Respect.'],
    [6, 'Es esmu redzējis, kā tu bēdz no lietus. Tu neesi nekāds snaiperis.'],

    // POST 7 - wut
    [7, 'Es redzu.'],
    [7, 'Neredzu.'],
    [7, 'Šis attēls man atņēma 4 cm no mana garuma.'],
    [7, 'Tas ir mans tēvs. Lūdzu izdzēs.'],
    [7, 'Kāpēc viņš izskatās pēc pašvaldības darbinieka?'],
    [7, 'Visu cieņu, bet šis ir labākais posts šajā forumā.'],
    [7, 'Bro is NOT soilmaxxing.'],
    [7, 'Man dators sāka smirdēt pēc mitras zemes.'],

    // POST 8 - Vaporeon copypasta
    [8, 'Es zvēru, ka šim forumam vajag moderatorus.'],
    [8, 'Kā biologs varu apstiprināt, ka šis nav bioloģijas jautājums.'],
    [8, 'Brāli, izslēdz internetu un aizej pieskarties augsnei.'],
    [8, 'Man bija normāla diena, līdz es izlasīju šo.'],
    [8, 'Viss, ko es gribēju, bija uzzināt par tārpiem.'],
    [8, 'Admini, lūdzu, pievienojiet iespēju bloķēt konkrētus cilvēkus.'],
    [8, 'Šis ir iemesls, kāpēc tārpiem nav piešķirtas cilvēktiesības.'],
    [8, 'Es izsaucu tārpu policiju.'],

    // POST 9 - Rick and Morty IQ
    [9, 'Man ir 147 IQ un es šo nesapratu.'],
    [9, 'Nīče raudētu, ja redzētu šo forumu.'],
    [9, 'Patiesībā tārpu nihilisms ir ļoti interesanta filozofiska tēma.'],
    [9, 'Brāli, tu esi lasījis vienu Vikipēdijas rakstu un tagad domā, ka esi Dostojevskis.'],
    [9, 'Wubba Lubba Dub Dub nozīmē, ka man vajag vairāk mēslu.'],
    [9, 'Tārpu tetovējums ir uz tava dzimumlocekļa, vai ne?'],

    // POST 10 - GTA bez noziedzības
    [10, 'Es gribētu GTA, kurā tu vienkārši strādā par kurjeru un maksā nodokļus.'],
    [10, 'Beidzot kāds normāls tārps.'],
    [10, 'Es gribu GTA 6, bet lai galvenais varonis ir slieka, kas cenšas nopirkt māju Rīgā.'],
    [10, 'Country radio vienīgais pareizais viedoklis.'],
    [10, 'Es gribētu spēli, kurā tu vari 8 stundas rakt tuneli un tad nomirt no traktora.'],
    [10, 'Rockstar, lūdzu, pievienojiet iespēju kļūt par kompostētāju.'],
    [10, 'Manuprāt, policistu šaušana ir slikta, bet kurmju šaušana ir pieņemama.'],
    [10, 'GTA: Gardening Theft Auto.'],
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
