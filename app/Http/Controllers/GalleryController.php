<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = [
            ['title' => 'Blokborrel 1', 'date' => '12-03-2024'],
            ['title' => 'Evenement B', 'date' => '15-03-2024'],
            ['title' => 'Evenement C', 'date' => '18-03-2024'],
            ['title' => 'Evenement D', 'date' => '20-03-2024'],
            ['title' => 'Evenement E', 'date' => '22-03-2024'],
            ['title' => 'Evenement F', 'date' => '25-03-2024'],
            ['title' => 'Blokborrel 1', 'date' => '12-03-2024'],
            ['title' => 'Evenement B', 'date' => '15-03-2024'],
            ['title' => 'Evenement C', 'date' => '18-03-2024'],
            ['title' => 'Evenement D', 'date' => '20-03-2024'],
        ];

        return view('gallery', compact('photos'));
    }
}
