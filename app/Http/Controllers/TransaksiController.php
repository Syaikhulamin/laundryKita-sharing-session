<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with('pelanggan')->orderBy('created_at', 'desc')->simplePaginate(10);

        return view('pages.transaksi.index')->with('transaksis', $transaksis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $layanans = Layanan::orderBy('nama_layanan')->get();

        return view('pages.transaksi.create', compact('pelanggans', 'layanans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'tgl_masuk' => 'required|date',
            'tgl_diambil' => 'required|date',
            'status_bayar' => 'required'
        ]);

        $transaksi = Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_user' => Auth::id(),
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_diambil' => $request->tgl_diambil,
            'status_bayar' => $request->status_bayar,
        ]);

        // handle detail items if provided
        if ($request->has('layanan_id') && is_array($request->layanan_id)) {
            foreach ($request->layanan_id as $i => $layananId) {
                $qty = (int) ($request->qty[$i] ?? 0);
                if (!$layananId || $qty <= 0) continue;
                $layanan = Layanan::find($layananId);
                if (!$layanan) continue;

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_layanan' => $layanan->id_layanan,
                    'qty' => $qty,
                    'subtotal' => $qty * $layanan->harga_persatuan,
                ]);
            }
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with('pelanggan', 'details.layanan')->where('id_transaksi', $id)->firstOrFail();

        return view('pages.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::with('details')->where('id_transaksi', $id)->firstOrFail();
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $layanans = Layanan::orderBy('nama_layanan')->get();

        return view('pages.transaksi.edit', compact('transaksi', 'pelanggans', 'layanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'tgl_masuk' => 'required|date',
            'tgl_diambil' => 'required|date',
            'status_bayar' => 'required'
        ]);

        Transaksi::where('id_transaksi', $id)->update([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_diambil' => $request->tgl_diambil,
            'status_bayar' => $request->status_bayar,
        ]);

        // replace details
        DetailTransaksi::where('id_transaksi', $id)->delete();
        if ($request->has('layanan_id') && is_array($request->layanan_id)) {
            foreach ($request->layanan_id as $i => $layananId) {
                $qty = (int) ($request->qty[$i] ?? 0);
                if (!$layananId || $qty <= 0) continue;
                $layanan = Layanan::find($layananId);
                if (!$layanan) continue;

                DetailTransaksi::create([
                    'id_transaksi' => $id,
                    'id_layanan' => $layanan->id_layanan,
                    'qty' => $qty,
                    'subtotal' => $qty * $layanan->harga_persatuan,
                ]);
            }
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DetailTransaksi::where('id_transaksi', $id)->delete();
        Transaksi::where('id_transaksi', $id)->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
