<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $buku = Book::all();
        // dd($buku); // dump and die

        return view('home', compact('buku'));
    }

    public function tambah()
    {
        return view('tambah');
    }

    public function simpan(Request $request)
    {
        // validasi
        $data = request()->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun' => 'required|numeric'
        ]);

        // menyimpan data
        $buku = new Book;
        $buku->judul = $data['judul'];
        $buku->penulis = $request->penulis;
        $buku->tahun = $data['tahun'];
        $buku->created_at = now();
        $buku->save();

        // return redirect()->back();
        return redirect('home');
    }
}
