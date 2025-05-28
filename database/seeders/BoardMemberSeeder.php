<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Support\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardMemberSeeder extends Seeder
{
    public function run()
    {
        DB::table('board_members')->insert([
            [
                'name' => 'Jules Verbruggen',
                'role' => 'Voorzitter',
                'bio' => 'Mijn naam is Jules Verbruggen, ik volg de richting software ontwikkeling...',
                'photo' => 'about-us/personal/jules_concat.png',
            ],
            [
                'name' => 'Sven Lempers',
                'role' => 'Secretaris',
                'bio' => 'Ik ben Sven, ik ben 20 jaar jaar en ik zit momenteel in het tweede jaar...',
                'photo' => 'about-us/personal/sven_concat.png',
            ],
            [
                'name' => 'Kim Nijsten',
                'role' => 'Penningmeester',
                'bio' => 'Mijn naam is Kim Nijsten en ik ben dit jaar de penningmeester...',
                'photo' => 'about-us/personal/kim_concat.png',
            ],
            [
                'name' => 'Bas Brekelmans',
                'role' => 'Commissaris Educatie',
                'bio' => 'Hallo, ik ben Bas Brekelmans. Ik ben 26 (bijna 27) jaar en woon in Tilburg...',
                'photo' => 'about-us/personal/bas_concat.png',
            ],
            [
                'name' => 'Josha van Engelen',
                'role' => 'Commissaris Extern',
                'bio' => 'Ik ben Josha van Engelen, 21 jaar en woon in Eindhoven...',
                'photo' => 'about-us/personal/josha_concat.png',
            ],
        ]);
    }
}
