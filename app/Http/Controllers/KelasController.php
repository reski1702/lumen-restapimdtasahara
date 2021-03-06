<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //token
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();

        if ($kelas) {
            return response()->json([
                'success'   => true,
                'message'   => 'Kelas Siswa',
                'data'      => $kelas
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ddta Tidak Ditemukan!',
            ], 404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_kelas' => 'required',
            'nama_kelas' => 'required'
        ]);

        $kelas = new Kelas;

        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;

        $kelas->save();

         return response()->json([
            'success' => true,
            'Message' => 'Data berhasil diupdate',
            'data'    => $kelas,
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::find($id);

        if ($kelas) {
            return response()->json([
                'success'   => true,
                'message'   => 'Kelas Siswa',
                'data'      => $kelas
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ddta Tidak Ditemukan!',
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);

        if(!$kelas){
            return response()->json([
                'success' => false,
                'Message' => 'Data tidak ditemukan'
            ],404);
        }

        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;

        $kelas->save();
        return response()->json([
            'success' => true,
            'Message' => 'Data berhasil diupdate',
            'data'    => $kelas,
        ],201);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $kelas = Kelas::find($id);
        if(!$kelas){
            return response()->json([
                'success' => false,
                'Message' => 'Data tidak ditemukan'
            ],404);
        }

        $kelas->delete();

        return response()->json([
            'success' => true,
            'Message' => 'Data berhasil dihapus'
        ],201);

    }
}
