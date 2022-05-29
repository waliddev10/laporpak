<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Esamsat;
use App\Models\JenisPkb;
use App\Models\Kasir;
use App\Models\PaymentPoint;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class LaporanHarianController extends Controller
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
                    <a class="btn btn-xs btn-success" href="' . route('laporan_harian.show', $item->id) . '"><i class="fas fa-eye fa-fw"></i></a>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.laporan_harian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentPoint $payment_point, JenisPkb $jenis_pkb)
    {
        $wilayah = Wilayah::all();
        $kasir = Kasir::all();

        return view('pages.laporan_harian.create', [
            'payment_point' => $payment_point,
            'jenis_pkb' => $jenis_pkb,
            'wilayah' => $wilayah,
            'kasir' => $kasir,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentPoint $payment_point, Request $request)
    {
        $this->validate($request, [
            'jenis_pkb_id' => 'required',
            'tgl_cetak' => 'required',
            'tgl_bayar' => 'required',
            'no_skpd' => 'required',
            'awalan_no_pol' => 'required',
            'no_pol' => 'required',
            'akhiran_no_pol' => 'required',
            'nilai_pokok' => 'required',
            'nilai_denda' => 'required',
            'wilayah_id' => 'required',
            'kasir_id' => 'required'
        ]);

        Esamsat::create([
            'payment_point_id' => $payment_point->id,
            'jenis_pkb_id' => $request->jenis_pkb_id,
            'tgl_cetak' => $request->tgl_cetak,
            'tgl_bayar' => $request->tgl_bayar,
            'no_skpd' => $request->no_skpd,
            'awalan_no_pol' => $request->awalan_no_pol,
            'no_pol' => $request->no_pol,
            'akhiran_no_pol' => $request->akhiran_no_pol,
            'nilai_pokok' => $request->nilai_pokok,
            'nilai_denda' => $request->nilai_denda,
            'wilayah_id' => $request->wilayah_id,
            'kasir_id' => $request->kasir_id,
        ]);

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
        if ($request->ajax()) {
            return DataTables::of(Esamsat::with(['jenis_pkb', 'wilayah', 'kasir'])->where('payment_point_id', $payment_point->id)->get())
                ->addColumn('action', function ($item) use ($payment_point) {
                    return '<div class="btn-group"><button class="btn btn-xs btn-warning" title="Ubah" data-toggle="modal" data-target="#modalContainer" data-title="Ubah" href="' .  route('laporan_harian.edit', ['payment_point' => $payment_point->id, 'esamsat' => $item->id]) . '"><i class="fas fa-edit fa-fw"></i></button><button href="' . route('laporan_harian.destroy', ['payment_point' => $payment_point->id, 'esamsat' => $item->id]) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>
                    </div>';
                })
                ->addColumn('no_pol_lengkap', function ($item) {
                    return '<div class="d-flex justify-content-between"><span>' . $item->awalan_no_pol . '</span><span class="mx-1">' . $item->no_pol . '</span><span>' . $item->akhiran_no_pol . '</span></div>';
                })
                ->editColumn('nilai_pokok', function ($item) {
                    return '<span class="float-left">Rp.</span><span class="float-right">' . number_format($item->nilai_pokok, 0, ',', '.') . '</span>';
                })
                ->editColumn('nilai_denda', function ($item) {
                    return '<span class="float-left">Rp.</span><span class="float-right">' . number_format($item->nilai_denda, 0, ',', '.') . '</span>';
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

        $jenis_pkb = JenisPkb::all();

        return view('pages.laporan_harian.show', [
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
        $wilayah = Wilayah::all();
        $kasir = Kasir::all();
        $jenis_pkb = JenisPkb::all();

        return view('pages.laporan_harian.edit', [
            'item' => $esamsat,
            'jenis_pkb' => $jenis_pkb,
            'payment_point' => $payment_point,
            'wilayah' => $wilayah,
            'kasir' => $kasir,
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
        $this->validate($request, [
            'jenis_pkb_id' => 'required',
            'tgl_cetak' => 'required',
            'tgl_bayar' => 'required',
            'no_skpd' => 'required',
            'awalan_no_pol' => 'required',
            'no_pol' => 'required',
            'akhiran_no_pol' => 'required',
            'nilai_pokok' => 'required',
            'nilai_denda' => 'required',
            'wilayah_id' => 'required',
            'kasir_id' => 'required'
        ]);

        $data = Esamsat::findOrFail($esamsat);
        $data->update($request->only([
            'jenis_pkb_id',
            'tgl_cetak',
            'tgl_bayar',
            'no_skpd',
            'awalan_no_pol',
            'no_pol',
            'akhiran_no_pol',
            'nilai_pokok',
            'nilai_denda',
            'wilayah_id',
            'kasir_id'
        ]));

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
