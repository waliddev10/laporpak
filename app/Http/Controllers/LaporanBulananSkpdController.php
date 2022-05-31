<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Esamsat;
use App\Models\JenisPkb;
use App\Models\Kasir;
use App\Models\KotaPenandatangan;
use App\Models\PaymentPoint;
use App\Models\Penandatangan;
use App\Models\Wilayah;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaporanBulananSkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view(
            'pages.laporan_bulanan.skpd.index',
            [
                'penandatangan' => Penandatangan::orderBy('nama', 'asc')->get(),
                'kota_penandatangan' => KotaPenandatangan::orderBy('nama', 'asc')->get(),
                'payment_point' => PaymentPoint::orderBy('nama', 'asc')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentPoint $payment_point, JenisPkb $jenis_pkb)
    {
        return view('pages.laporan_bulanan.skpd.create');
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
        return view('pages.laporan_bulanan.skpd.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentPoint $payment_point, Esamsat $esamsat)
    {
        return view('pages.laporan_bulanan.skpd.edit');
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
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'tahun' => 'required',
            'penandatangan1_id' => 'required',
            'penandatangan2_id' => 'required',
            'penandatangan3_id' => 'required',
            'tgl_ttd' => 'required|date',
        ]);

        $esamsat_data = Esamsat::with(['kasir_pembayaran'])
            ->when($request->payment_point_id, function ($query) use ($request) {
                return $query->where('payment_point_id', $request->payment_point_id);
            })
            ->when($request->bulan, function ($query) use ($request) {
                return $query->whereMonth('tgl_cetak', $request->bulan);
            })
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereYear('tgl_cetak', $request->tahun);
            })
            // ->when($request->tgl_mulai, function ($query) use ($request) {
            //     return $query->whereDate('tgl_cetak', '>=', date('Y-m-d', $request->tgl_mulai));
            // })
            // ->when($request->tgl_selesai, function ($query) use ($request) {
            //     return $query->whereDate('tgl_cetak', '<=', date('Y-m-d', $request->tgl_selesai));
            // })
            ->orderBy('tgl_cetak', 'asc')
            ->get();

        $data = $esamsat_data->groupBy('tgl_cetak')
            ->filter(function ($item, $key) use ($request) {
                if (Carbon::parse($key) >= Carbon::parse($request->tgl_mulai) && Carbon::parse($key) <= Carbon::parse($request->tgl_selesai)) {
                    return $item;
                }
            });

        $pdf = PDF::loadView('pdf.laporan_bulanan.skpd', [
            'data' => $data,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'payment_point' => PaymentPoint::findOrFail($request->payment_point_id),
            'penandatangan1' => Penandatangan::findOrFail($request->penandatangan1_id),
            'penandatangan2' => Penandatangan::findOrFail($request->penandatangan2_id),
            'penandatangan3' => Penandatangan::findOrFail($request->penandatangan3_id),
            'tgl_ttd' => $request->tgl_ttd,
        ]);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream('laporan_bulanan_skpd.pdf');
    }
}
