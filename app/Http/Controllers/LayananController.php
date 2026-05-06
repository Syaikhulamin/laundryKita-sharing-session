<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('pages.layanan.index')->with('layanans', $layanan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.layanan/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $this->validate($request, [
                'nama_layanan' => 'required|unique:layanans,nama_layanan',
                'harga_persatuan' => 'required|numeric|min:0'
            ]);

            $layanan = new Layanan();
            $layanan->nama_layanan = $request->nama_layanan;
            $layanan->harga_persatuan = $request->harga_persatuan;

            $layanan->save();

            return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanan = Layanan::where('id_layanan', $id)->first();

        $data = [
            'service' => $layanan
        ];

        return view('pages.layanan/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        Layanan::where('id_layanan', $id)->update([
            'nama_layanan' => $request->nama_layanan,
            'harga_persatuan' => $request->harga_persatuan
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $layanan = Layanan::where('id_layanan', $id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}
