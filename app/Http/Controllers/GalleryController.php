<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $photos = [
            ['title' => 'Studiereis Gent','date' => '12-03-2024', 'type' => 'education', 'src' => asset('storage/gallery/concat_foto_1.png'),],
            ['title' => 'Studiereis Gent','date' => '15-03-2024', 'type' => 'education', 'src' => asset('storage/gallery/concat_foto_2.png'),],
            ['title' => 'Evenement A', 'date' => '12-03-2024', 'type' => 'education', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement B', 'date' => '15-03-2024', 'type' => 'blokborrel', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement C', 'date' => '18-03-2024', 'type' => 'blokborrel', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement D', 'date' => '20-03-2024', 'type' => 'blokborrel', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement E', 'date' => '22-03-2024', 'type' => 'blokborrel', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement F', 'date' => '25-03-2024', 'type' => 'blokborrel', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement G', 'date' => '12-03-2024', 'type' => 'education', 'src' => asset('storage/gallery/concat_foto_1.png')],
            ['title' => 'Evenement H', 'date' => '15-03-2024', 'type' => 'education', 'src' => asset('storage/gallery/concat_foto_1.png')],
        ];

        if ($request->filled('type')) {
            $photos = array_filter($photos, function ($photo) use ($request) {
                return $photo['type'] === $request->type;
            });
        }

        return view('gallery.gallery', compact('photos'));
    }
}
