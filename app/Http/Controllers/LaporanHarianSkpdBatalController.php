<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Esamsat;
use App\Models\JenisPkb;
use App\Models\PaymentPoint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class LaporanHarianSkpdBatalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(PaymentPoint::all())
                ->addColumn('action', function ($item) {
                    return '<div class="btn-group">
                    <a class="btn btn-xs btn-success" href="' . route('laporan_harian_skpd_batal.show', $item->id) . '"><i class="fas fa-eye fa-fw"></i></a>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.laporan_harian_skpd_batal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentPoint $payment_point, Request $request)
    {
        $esamsats = Esamsat::with(['jenis_pkb', 'wilayah', 'kasir', 'kasir_pembayaran'])
            ->where('status_batal', true)
            ->where('payment_point_id', $payment_point->id)
            ->orderBy('tgl_cetak', 'desc')
            ->when($request->has('bulan') && $request->bulan != 'Semua', function ($query) use ($request) {
                $query->whereMonth('tgl_cetak', $request->bulan);
            })
            ->when($request->has('tahun'), function ($query) use ($request) {
                $query->whereYear('tgl_cetak', $request->tahun);
            })
            ->get();

        if ($request->ajax()) {
            return DataTables::of($esamsats)
                ->addColumn('action', function ($item) use ($payment_point) {
                    return '<div class="btn-group">                    
                    <button title="Hapus Data" href="' . route('laporan_harian.destroy', ['payment_point' => $payment_point->id, 'esamsat' => $item->id]) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>

                    <button title="Aktifkan SKPD" href="' . route('laporan_harian_skpd_batal.update', ['payment_point' => $payment_point->id, 'esamsat' => $item->id]) . '" class="btn btn-xs btn-success batal" data-target-table="tableDokumen"><i class="fa fa-power-off"></i></button>
                    </div>';
                })
                ->addColumn('no_pol_lengkap', function ($item) {
                    return '<div class="d-flex justify-content-between"><span>' . $item->awalan_no_pol . '</span><span class="mx-1">' . $item->no_pol . '</span><span>' . $item->akhiran_no_pol . '</span></div>';
                })
                ->editColumn('nilai_pokok', function ($item) {
                    return '<small class="float-left">Rp.</small><span class="float-right">' . number_format($item->nilai_pokok, 0, ',', '.') . '</span>';
                })
                ->editColumn('nilai_denda', function ($item) {
                    return '<small class="float-left">Rp.</small><span class="float-right">' . number_format($item->nilai_denda, 0, ',', '.') . '</span>';
                })
                ->addColumn('esamsat', function ($item) {
                    if ($item->status_esamsat == true)
                        return  $item->kasir_pembayaran->nama;

                    return '-';
                })
                ->rawColumns([
                    'action',
                    'no_pol_lengkap',
                    'nilai_pokok',
                    'nilai_denda'
                ])
                ->addIndexColumn()
                ->make(true);
        }

        $jenis_pkb = JenisPkb::orderBy('nama', 'asc')->get();

        return view('pages.laporan_harian_skpd_batal.show', [
            'payment_point' => $payment_point,
            'jenis_pkb' => $jenis_pkb
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentPoint $payment_point, Esamsat $esamsat)
    {
        return view('pages.laporan_harian_skpd_batal.edit', [
            'item' => $esamsat,
            'payment_point' => $payment_point,
        ]);
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
        $data = Esamsat::findOrFail($esamsat);

        if ($data->status_batal == true) {
            $data->keterangan = null;
            $data->status_batal = false;
            $data->update();

            return response()->json([
                'status' => 'success',
                'message' => 'SKPD berhasil diaktifkan kembali.',
            ], Response::HTTP_ACCEPTED);
        }

        if ($data->status_batal == false) {
            $this->validate($request, [
                'keterangan' => 'required',
            ]);

            $data->keterangan = $request->keterangan;
            $data->status_batal = true;
            $data->update();

            return response()->json([
                'status' => 'success',
                'message' => 'SKPD berhasil dibatalkan.',
            ], Response::HTTP_ACCEPTED);
        }
    }
}
