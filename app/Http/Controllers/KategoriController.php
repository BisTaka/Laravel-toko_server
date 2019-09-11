<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriBarang;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isi_kategori = KategoriBarang::simplePaginate(10);

        return view('kategori.index' , compact('data_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.buat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = new KategoriBarang();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return back()->with('status', 'Kategori Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = KategoriBarang::find('id');
        return view('kategori.edit', compact('kategori', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = KategoriBarang::find('id');
        $this->validate(request(), [
            'nama_kategori' => 'required',
        ]);

        $kategori->nama_kategori = $request->get('nama_kategori');
        $kategori->save();

        return redirect('kategori')->with('status', 'Kategori Produk Berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = KategoriBarang::find('id');
        $kategori->delete();
        return redirect('kategori')->with('status', 'Kategori Barang berhasil dihapus');
    }
}
