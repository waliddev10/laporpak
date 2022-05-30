<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Esamsat;
use App\Models\JenisPkb;
use App\Models\KotaPenandatangan;
use App\Models\PaymentPoint;
use App\Models\Penandatangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaporanBulananEsamsatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.laporan_bulanan.esamsat.index', [
            'penandatangan' => Penandatangan::all(),
            'kota_penandatangan' => KotaPenandatangan::all(),
            'payment_point' => PaymentPoint::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentPoint $payment_point, JenisPkb $jenis_pkb)
    {
        return view('pages.laporan_bulanan.esamsat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentPoint $payment_point, Request $request)
    {

        return response()->json([
            'status' => 'success',
            'message' => 'Esamsat berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentPoint $payment_point, Request $request)
    {
        return view('pages.laporan_bulanan.esamsat.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentPoint $payment_point, Esamsat $esamsat)
    {
        return view('pages.laporan_bulanan.esamsat.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $payment_point, $esamsat)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Esamsat berhasil diubah.',
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($payment_point, $esamsat)
    {
        $data = Esamsat::findOrFail($esamsat);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Esamsat berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'payment_point_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'penandatangan1_id' => 'required',
            'penandatangan2_id' => 'required',
            'tgl_ttd' => 'required|date',
            'kota_penandatangan_id' => 'required',
        ]);

        $data = Esamsat::with(['kasir_pembayaran'])
            ->where('status_esamsat', true)
            ->when($request->payment_point_id, function ($query) use ($request) {
                return $query->where('payment_point_id', $request->payment_point_id);
            })
            ->when($request->bulan, function ($query) use ($request) {
                return $query->whereMonth('tgl_cetak', $request->bulan);
            })
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereYear('tgl_cetak', $request->tahun);
            })
            ->orderBy('tgl_cetak', 'asc')
            ->get();

        $pdf = PDF::loadView('pdf.laporan_bulanan.esamsat', [
            'data' => $data,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'payment_point' => PaymentPoint::findOrFail($request->payment_point_id),
            'penandatangan1' => Penandatangan::findOrFail($request->penandatangan1_id),
            'penandatangan2' => Penandatangan::findOrFail($request->penandatangan2_id),
            'tgl_ttd' => $request->tgl_ttd,
            'kota_penandatangan' => KotaPenandatangan::findOrFail($request->kota_penandatangan_id),
        ]);
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream('laporan_bulanan-esamsat.pdf');
    }
}
