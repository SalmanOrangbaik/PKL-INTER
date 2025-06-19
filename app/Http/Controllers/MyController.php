<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //data array
    private $data = [
        ['id' => 1, 'judul' => 'Mencari jati diri', 'harga' => 75000, 'kategori' => 'Self Improvment'],
        ['id' => 2, 'judul' => 'Bacaan sholat dan dzikir', 'harga' => 25000, 'kategori' => 'Bacaan'],
        ['id' => 3, 'judul' => 'Laravel 12 Fundamental', 'harga' => 350000, 'kategori' => 'Teknologi'],

    ];

    public function index()
    {
        //mengambil data array lalu dimasukan ke sebuah session 'data_buku'
        $buku = session('data_buku', $this->data);
        return view('buku.index', compact('buku'));

    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(REQUEST $request)
    {
        $buku = session('data_buku', $this->data);
        //membuat id baru secara increment
        $newId = collect($buku)->max('id') + 1;

        //proses menampung data buku
        $buku[] = [
            'id'       => $newId,
            'judul'    => $request->judul,
            'harga'    => $request->harga,
            'kategori' => $request->kategori,
        ];

        //menambahkan buku baru ke session data_buku variabel buku
        session(['data_buku' => $buku]);

        return redirect('buku');
    }

    public function show($id)
    {
        $buku = session('data_buku', $this->data);
        $buku = collect($buku)->firstWhere('id', $id);

        //jika buku tidak di temukan di alihkan ke halaman 404
        if (! $buku) {
            abort(404);
        }

        return view('buku.show', compact('buku'));
    }

    public function edit($id)
    {
        $buku = session('data_buku', $this->data);
        $buku = collect($buku)->firstWhere('id', $id);

        //jika buku tidak di temukan di alihkan ke halaman 404
        if (! $buku) {
            abort(404);
        }

        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = session('data_buku', $this->data);

        //mencari data buku berdasarkan id
        foreach ($buku as &$data) {
            if ($data['id'] == $id) {
                $data['judul']    = $request->judul;
                $data['harga']    = $request->harga;
                $data['kategori'] = $request->kategori;
                break;
            }
        }

        //mengembalikan data buku yang sudah di update ke dalam session
        session(['data_buku' => $buku]);

        return redirect('/buku');
    }

    public function destroy($id)
    {
        $buku = session('data_buku', $this->data);

        //cari index
        $index = array_search($id, array_column($buku, 'id'));
        array_splice($buku, $index, 1);

        session(['data_buku' => $buku]);

        return redirect('/buku');
    }
}
