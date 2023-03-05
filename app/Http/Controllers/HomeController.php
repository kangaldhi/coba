<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = Buku::get();

        $book_api = Http::get('https://www.googleapis.com/books/v1/volumes?q=masakan');

        $books = json_decode($book_api->body());

        return view('home', compact('data','books'));
    }

    public function get_data(Request $request)
    {
        $data = Buku::where('nama_buku', 'like', "%$request->search%")->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil get data',
            'data' => $data,
        ], 200);
    }

    public function like(Request $request)
    {
        $data = Buku::findOrfail($request->id);
        $data->like += 1;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambah like',
            'like_count' => $data->like,
        ], 200);
    }
}
