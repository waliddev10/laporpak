<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\KasirPembayaran;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class KasirPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(KasirPembayaran::all())
                ->addColumn('action', function ($item) {
                    return '<div class="btn-group">
                    <button class="btn btn-xs btn-info" title="Ubah" data-toggle="modal" data-target="#modalContainer" data-title="Ubah" href="' . route('kasir_pembayaran.edit', $item->id) . '"><i class="fas fa-edit fa-fw"></i></button>
                    <button href="' . route('kasir_pembayaran.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.pengaturan.kasir_pembayaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengaturan.kasir_pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
        ]);

        KasirPembayaran::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'KasirPembayaran berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(KasirPembayaran $kasir_pembayaran)
    {
        // return view('pages.pengaturan.kasir_pembayaran.show', ['item' => $kasir_pembayaran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(KasirPembayaran $kasir_pembayaran)
    {
        return view('pages.pengaturan.kasir_pembayaran.edit', ['item' => $kasir_pembayaran]);
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
        $this->validate($request, [
            'nama' => 'required|string'
        ]);

        $data = KasirPembayaran::findOrFail($id);
        $data->update($request->only([
            'nama'
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'KasirPembayaran berhasil diubah.',
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KasirPembayaran::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'KasirPembayaran berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
