<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Pangkat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(User::with(['pangkat', 'bidang'])->get())
                ->addColumn('action', function ($item) {
                    return '<button class="btn btn-xs btn-primary" title="Ubah" data-bs-toggle="modal" data-bs-target="#modalContainer" data-title="Ubah" href="' . route('user.edit', $item->id) . '"><i class="fa fa-edit fa-fw"></i></button>
                    <button href="' . route('user.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.data_master.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'pages.data_master.user.create',
            [
                'bidang' => Bidang::all(),
                'pangkat' => Pangkat::all(),
            ]
        );
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
            'email' => 'required|email',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'pangkat_id' => 'required',
            'bidang_id' => 'required',
            'no_hp' => 'required',
            'password' => 'required|string',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'pangkat_id' => $request->pangkat_id,
            'bidang_id' => $request->bidang_id,
            'no_hp' => $request->no_hp,
            'email_verified_at' => Carbon::now()->format('Y-m-d'),
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.data_master.user.edit', [
            'item' => $user,
            'bidang' => Bidang::all(),
            'pangkat' => Pangkat::all(),
        ]);
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
            'email' => 'required|email',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'pangkat_id' => 'required',
            'bidang_id' => 'required',
            'no_hp' => 'required',
            'password' => 'nullable',
            'role' => 'required|in:admin,user',
        ]);

        $data = User::findOrFail($id);
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->nip = $request->nip;
        $data->jabatan = $request->jabatan;
        $data->pangkat_id = $request->pangkat_id;
        $data->bidang_id = $request->bidang_id;
        $data->no_hp = $request->no_hp;
        $data->role = $request->role;
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil diubah.',
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
        $data = User::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
