<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Gallery;


class GalleryController extends Controller
{

    public function index()
    {
        $data = Gallery::all();


        return view('index',compact("data"));

    }

    public function create()
    {
        return view('gallery');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:2048' // Validation rules for upload
        ]);

        $upload = new Gallery();

        $image = $request->file('image');

        $image = Storage::disk('minio')->putFile('', $image); // Upload a file

        $upload->path = $image;
        $upload->save();

        $data = Gallery::all();


        return view('index',compact("data"));
    }
}