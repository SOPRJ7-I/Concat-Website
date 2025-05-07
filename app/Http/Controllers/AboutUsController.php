<?php

namespace App\Http\Controllers;

class AboutUsController extends Controller
{
    public function index()
    {
        $currentBoard = [
            [
                'name' => 'Emma de Jong',
                'role' => 'Voorzitter',
                'bio' => 'Emma zorgt voor de algemene coördinatie en vertegenwoordiging van de vereniging naar buiten toe. Ze is altijd bezig met nieuwe initiatieven en het verbinden van leden. Emma zorgt voor de algemene coördinatie en vertegenwoordiging van de vereniging naar buiten toe. Ze is altijd bezig met nieuwe initiatieven en het verbinden van leden.',
                'photo' => '/images/bestuur/emma.jpg',
            ],
            [
                'name' => 'Lars van Dijk',
                'role' => 'Penningmeester',
                'bio' => 'Lars houdt het financiële overzicht en zorgt ervoor dat alles netjes geboekt wordt. Dankzij hem blijven we binnen budget én dromen we groot.',
                'photo' => '/images/bestuur/lars.jpg',
            ],
            [
                'name' => 'Sophie Janssen',
                'role' => 'Secretaris',
                'bio' => 'Sophie beheert de administratie, notuleert tijdens vergaderingen en is het aanspreekpunt voor vragen via e-mail. Ze brengt rust en overzicht. Sophie beheert de administratie, notuleert tijdens vergaderingen en is het aanspreekpunt voor vragen via e-mail. Ze brengt rust en overzicht.',
                'photo' => '/images/bestuur/sophie.jpg',
            ],
            [
                'name' => 'Noah Visser',
                'role' => 'Commissaris Activiteiten',
                'bio' => 'Noah bedenkt, organiseert en evalueert onze activiteiten. Van borrels tot lezingen, hij zorgt dat er altijd wat te doen is.',
                'photo' => '/images/bestuur/noah.jpg',
            ],
        ];

        $previousBoards = [
            [
                'year' => '2023-2024',
                'members' => 'Emma, Lars, Sophie, Noah',
            ],
            [
                'year' => '2022-2023',
                'members' => 'Mila, Bram, Lotte, Tim',
            ],
            [
                'year' => '2021-2022',
                'members' => 'Eva, Thomas, Sanne, Daan',
            ],
        ];

        return view('about-us.index', compact('currentBoard', 'previousBoards'));
    }
}
