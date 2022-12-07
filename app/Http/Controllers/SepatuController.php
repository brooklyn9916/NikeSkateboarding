<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepatu;

class SepatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sepatu = Sepatu::all();
        return $sepatu;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = sepatu::create([
            "nama" => $request->nama,
            "harga" => $request->harga,
            "deskripsi" => $request->deskripsi,
            "stok" => $request->stok
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Sepatu tersimpan',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sepatu = Sepatu::find($id);
        if ($sepatu) {
            return response()->json([
                'status' => 200,
                'data' => $sepatu
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ID ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $sepatu = Sepatu::find($id);
        if($sepatu){
            $sepatu->nama = $request->nama ? $request->nama : $sepatu->nama;
            $sepatu->harga = $request->harga ? $request->harga : $sepatu->harga;
            $sepatu->deskripsi = $request->deskripsi ? $request->deskripsi : $sepatu->deskripsi;
            $sepatu->stok = $request->stok ? $request->stok : $sepatu->stok;
            $sepatu->save();
            return response()->json([
                'status' => 200,
                'data' => $sepatu
            ], 200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=> $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sepatu = Sepatu::where('id',$id)->first();
        if($sepatu){
            $sepatu->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'food successfully erased',
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id . ' tidak ditemukan'
            ]);
        }
    }
}
