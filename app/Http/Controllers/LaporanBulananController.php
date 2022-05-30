<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Esamsat;
use App\Models\JenisPkb;
use App\Models\PaymentPoint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaporanBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('pages.laporan_bulanan.index');

        $data = Esamsat::with(['kasir_pembayaran'])
            ->where('status_esamsat', true)
            ->orderBy('tgl_cetak', 'asc')
            ->get();

        $pdf = PDF::loadView('pdf.laporan_bulanan.esamsat', [
            'data' => $data
        ]);
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream('laporan_bulanan-esamsat.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentPoint $payment_point, JenisPkb $jenis_pkb)
    {
        return view('pages.laporan_bulanan.create');
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
        return view('pages.laporan_bulanan.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentPoint $payment_point, Esamsat $esamsat)
    {
        return view('pages.laporan_bulanan.edit');
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
}
