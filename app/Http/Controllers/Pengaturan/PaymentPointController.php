<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\PaymentPoint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PaymentPointController extends Controller
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
                    <button class="btn btn-xs btn-info" title="Ubah" data-toggle="modal" data-target="#modalContainer" data-title="Ubah" href="' . route('payment_point.edit', $item->id) . '"><i class="fas fa-edit fa-fw"></i></button>
                    <button href="' . route('payment_point.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.pengaturan.payment_point.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengaturan.payment_point.create');
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
            'alamat' => 'required|string',
        ]);

        PaymentPoint::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment Point berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentPoint $payment_point)
    {
        // return view('pages.pengaturan.payment_point.show', ['item' => $payment_point]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentPoint $payment_point)
    {
        return view('pages.pengaturan.payment_point.edit', ['item' => $payment_point]);
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
            'alamat' => 'required|string'
        ]);

        $data = PaymentPoint::findOrFail($id);
        $data->update($request->only([
            'nama',
            'alamat',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Payment Point berhasil diubah.',
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
        $data = PaymentPoint::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment Point berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
