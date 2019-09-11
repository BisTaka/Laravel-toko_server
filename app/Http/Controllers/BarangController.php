<?php

namespace App\Http\Controllers;

use App\Barang;
use App\KategoriBarang;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class BarangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_barang = Barang::simplePaginate(10);
        $data_kategori = KategoriBarang::all();
        return view('barang.index', compact('data_barang', 'data_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_kategori= KategoriBarang::all();
        return view('barang.buat' , compact('data_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Input::hasFile('gambar')) {
            $barang = new Barang();
            $barang->nama_produk = $request->nama_produk;
            $barang->id_kategori = $request->id_kategori;
            $barang->harga = $request->harga;
            $barang->deskripsi = $request->deskripsi;

            $gambar = Input::file('gambar');
            $gambar->move('uploads', $gambar->getClientOriginalName());

            $barang->gambar = $gambar->getClientOriginalName();
            $barang->save();

            return redirect('barang')->with('status' , 'Barang berhasil ditambahkan');
        }
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
        $barang = Barang::find('id');
        $data_kategori = KategoriBarang::all();

        return view('barang.edit' , compact('barang', 'data_kategori', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $barang =  Barang::find('id');
        $barang->nama_produk = $request->get('nama_produk');
        $data_kategori = KategoriBarang::find($request->get('id_kategori'));
        $barang->kategori()->associate($data_kategori);
        $barang->harga = $request->get('harga');
        $barang->deskripsi = $request->get('deskripsi');

        if (Input::hasFile('gambar')) {
            $gambar = Input::hasFile('gambar');
            $gambar->move('uploads', $gambar->getClientOriginalName());
            $barang->gambar = $gambar->getClientOriginalName();
        }

        $barang->save();
        return redirect('barang')->with('status', 'Produk berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find('id');
        $barang->delete();

        return redirect('barang')->with('status' , 'Barang berhasil dihapus');
    }
}
