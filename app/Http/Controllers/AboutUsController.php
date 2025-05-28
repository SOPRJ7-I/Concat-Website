<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use App\Models\PreviousBoard;

class AboutUsController extends Controller
{
    public function index()
    {

        $currentBoard = BoardMember::all();

        $previousBoards = PreviousBoard::all()->map(function ($board) {
             return [
            'from' => \Carbon\Carbon::parse($board->FromYear)->format('Y'),
            'to' => \Carbon\Carbon::parse($board->ToYear)->format('Y'),
            'members' => $board->members,
            'photo' => $board->photo,
            ];
            });

        return view('about-us.index', compact('currentBoard', 'previousBoards'));
    }
}
