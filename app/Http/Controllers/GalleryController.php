<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = [
            ['title' => 'Studiereis Gent', 'date' => '12-03-2024', 'src' => asset('storage/gallery/img.png')],
            ['title' => 'Studiereis Gent', 'date' => '12-03-2024', 'src' => asset('storage/gallery/img_1.png')],
            ['title' => 'Evenement A', 'date' => '12-03-2024', 'src' => asset('storage/gallery/img_2.png')],
            ['title' => 'Evenement B', 'date' => '15-03-2024', 'src' => asset('storage/gallery/img_3.png')],
            ['title' => 'Evenement C', 'date' => '18-03-2024', 'src' => asset('storage/gallery/img_4.png')],
            ['title' => 'Evenement D', 'date' => '20-03-2024', 'src' => asset('storage/gallery/img_5.png')],
            ['title' => 'Evenement E', 'date' => '22-03-2024', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement F', 'date' => '25-03-2024', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement G', 'date' => '12-03-2024', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement H', 'date' => '15-03-2024', 'src' => asset('storage/gallery/concat_foto_1.png')],
        ];

        return view('gallery', compact('photos'));
    }
}
