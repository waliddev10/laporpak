<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Esamsat;
use App\Models\KotaPenandatangan;
use App\Models\PaymentPoint;
use App\Models\Penandatangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function print(Request $request)
    {
        $this->validate($request, [
            'payment_point_id' => 'required',
            'bulan' => 'required',
            'no_surat' => 'required',
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
            'no_surat' => $request->no_surat,
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
