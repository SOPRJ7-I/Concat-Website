<?php

namespace App\Http\Controllers;

class AboutUsController extends Controller
{
    public function index()
    {
        $currentBoard = [
            [
                'name' => 'Jules Verbruggen',
                'role' => 'Voorzitter',
                'bio' => 'Mijn naam is Jules Verbruggen, ik volg de richting software ontwikkeling en ik zit momenteel in mijn tweede leerjaar. In mijn eerste leerjaar ben ik erg actief geweest binnen concat. Ik ben bij veel van de activiteiten aanwezig geweest waaronder de community avonden waarop wij een huiswerk/chill avond hebben na school. Hier heb ik erg veel kunnen leren door informatie uit te wisselen met mijn medestudenten. Dit soort activiteiten hebben mij erg geholpen. Ik ben daarom ook mee dit bestuursjaar gaan doen, omdat ik het belangrijk vind deze community te behouden zodat wij elkaar kunnen helpen maar ook gezellige herinneringen kunnen maken. In dit bestuursjaar neem ik de rol van voorzitter aan en zal ik ook verantwoordelijk zijn voor de events, recreatie, blokborrels, continuïteit, recruitment, website en introcommissie.
Liefs,
Jules',
                'photo' => asset('storage/about-us/personal/jules_concat.png'),
            ],
            [
                'name' => 'Sven Lempers',
                'role' => 'Secretaris',
                'bio' => 'Ik ben Sven, ik ben 20 jaar jaar en ik zit momenteel in het tweede jaar van de opleiding informatica. Ik ben bij het bestuur van concat gegaan om een gezellige sfeer te creeëren voor al onze leden, en om een positieve bijdrage te leveren aan onze studententijd. In mijn vrije tijd ben ik vrijwilliger bij scouting en vind ik het leuk om met technologie te knutselen
Liefs,
Sven',
                'photo' => asset('storage/about-us/personal/sven_concat.png'),
            ],
            [
                'name' => 'Kim Nijsten',
                'role' => 'Penningmeester',
                'bio' => 'Mijn naam is Kim Nijsten en ik ben dit jaar de penningmeester van SV Concat. Ik ben 18 jaar oud en zit in het tweede jaar Software Ontwikkeling. In mijn vrije tijd ben ik vaak op het voetbalveld te vinden, waar ik minimaal drie keer per week ben. Ik heb ervoor gekozen om penningmeester te worden, omdat ik afgelopen schooljaar al heel erg betrokken was bij de studievereniging en toen ook bij de kascommissie zat. Ik heb heel veel zin in dit schooljaar en kijk ernaar uit om samen met de rest van het bestuur een mooi jaar neer te gaan zetten.
Liefs,
Kim',
                'photo' => asset('storage/about-us/personal/kim_concat.png'),
            ],
            [
                'name' => 'Bas Brekelmans',
                'role' => 'Commissaris Educatie',
                'bio' => 'Hallo, ik ben Bas Brekelmans.
Ik ben 26 (bijna 27) jaar en woon in Tilburg. Ik ben een tweedejaars student in de richting softwareontwikkeling en de nieuwe commissaris educatie van het vierde bestuur van SV Concat! Concat heeft altijd leuke activiteiten georganiseerd voor studenten tijdens de communityavonden, en dit zal ik dit schooljaar voortzetten. Mijn doel bij Concat is om de groei van studenten te bevorderen. Buiten school ben ik graag actief bezig met boulderen, fitness en ga ik ook graag naar concerten. Als je vragen of suggesties hebt, kun je altijd bij me terecht op school.
Liefs,
Bas',
                'photo' => asset('storage/about-us/personal/bas_concat.png'),
            ],
            [
                'name' => 'Josha van Engelen',
                'role' => 'Commissaris Extern',
                'bio' => 'Ik ben Josha van Engelen, 21 jaar en woon in Eindhoven. Ik volg de SO major en begin dit jaar aan mijn stage. Hiernaast vind ik het leuk om te boulderen, bezig te zijn met muziek (vooral luisteren en een beetje maken), poolen, schrijven of gezellig een drankje te drinken natuurlijk.
Ik heb 2 jaar terug meegeholpen met het organiseren van de 1e studiereis van Concat en vorig jaar heb ik meegedraaid als voorzitter van het bestuur. Dit jaar zal ik nog een keertje deel uitmaken van het bestuur, ditmaal als commissaris extern, omdat ik het leuk vind om betrokken te blijven bij de vereniging. Heb je vragen? Dan mag je altijd bij mij of natuurlijk de rest van het bestuur benaderen via de mail of via discord!
Liefs,
Josha',
                'photo' => asset('storage/about-us/personal/josha_concat.png'),
            ],
        ];

        $previousBoards = [
            [
                'year' => '2024-2025',
                'members' => 'Jules Verbruggen, Sven Lempers, Kim Nijsten, Bas Brekelmans, Josha van Engelen',
                'photo' => asset('storage/about-us/personal/board/bestuur_2024_2025_concat.png'),
            ],
            [
                'year' => '2023-2024',
                'members' => 'Josha van Engelen, Kevin Bouwmeester, Emily Braun',
                'photo' => asset('storage/about-us/personal/board/bestuur_2023_2024_concat.png'),
            ],
            [
                'year' => '2022-2023',
                'members' => 'Jesse van den Ende, Carli van Zandvoort, Noor Houben, Stijn Lingmont',
                'photo' => asset('storage/about-us/personal/board/bestuur_2022_2023_concat.png'),
            ],
            [
                'year' => '2021-2022',
                'members' => 'Tessa Hoeben, Linn Smetsers, Niels Verheggen, Ruben Dommerholt',
                'photo' => asset('storage/about-us/personal/board/bestuur_2021_2022_concat.png'),
            ],
            [
                'year' => '2020-2021',
                'members' => 'Emma, Lars, Sophie, Noah',
                'photo' => asset('storage/about-us/personal/board/testfoto.png'),
            ],
        ];

        return view('about-us.index', compact('currentBoard', 'previousBoards'));
    }
}
