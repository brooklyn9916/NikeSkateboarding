<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sepatu;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Order;

class TransaksiController extends Controller
{
    public function index()
    {
        $order = Transaksi::all();
        return $order;
    }

    public function store(Request $request)
    {               
           

            if($request->bayar < $request->total)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'duit anda tidak cukup',
                ], 200);
            }else{
                $order = Transaksi::create([
                    'date' => $request->date,
                    'id_transaksi' => $request->id_transaksi,
                    'id_order' => $request->id_order,
                    'total' => $request->total,
                    'bayar' => $request->bayar,
                    'kembalian' => $request->bayar - $request->total,
                    'status' => 'pending',
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order successfully added',
                'data' => $order
            ], 200);
    }

    public function show($id) 
    {
        $order = Transaksi::find($id);
        if ($order) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Order successfully shown',
                'data' => $order
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'The ID above ' . $id . ' is not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $order = Transaksi::find($id);
        $order->delete();
        if ($order) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Order successfully deleted',
                'data' => $order
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'The ID above ' . $id . ' is not found'
            ], 404);
        }
    }
}
