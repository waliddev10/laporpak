<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Penandatangan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PenandatanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Penandatangan::all())
                ->addColumn('action', function ($item) {
                    return '<div class="btn-group">
                    <button class="btn btn-xs btn-info" title="Ubah" data-toggle="modal" data-target="#modalContainer" data-title="Ubah" href="' . route('penandatangan.edit', $item->id) . '"><i class="fas fa-edit fa-fw"></i></button>
                    <button href="' . route('penandatangan.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.pengaturan.penandatangan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengaturan.penandatangan.create');
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
            'jabatan' => 'required|string',
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'nip' => 'required|string',
        ]);

        Penandatangan::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'nip' => $request->nip,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Penandatangan berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penandatangan $penandatangan)
    {
        // return view('pages.pengaturan.penandatangan.show', ['item' => $penandatangan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penandatangan $penandatangan)
    {
        return view('pages.pengaturan.penandatangan.edit', ['item' => $penandatangan]);
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
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'nip' => 'required|string',
        ]);

        $data = Penandatangan::findOrFail($id);
        $data->update($request->only([
            'nama',
            'jabatan',
            'pangkat',
            'golongan',
            'nip',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Penandatangan berhasil diubah.',
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
        $data = Penandatangan::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Penandatangan berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
