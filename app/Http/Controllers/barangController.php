<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang_model;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class barangController extends Controller
{
    public function index(){
      if(Auth::user()->level=="admin"){
        $barang=barang_model::get();
        return response()->json($barang);
      } else {
        return response()->json(['status'=>'anda bukan admin']);
      }
    }

    public function store(Request $req){
      $validator = Validator::make($req->all(),
      [
        'nama_barang' => 'required',
        'stok' => 'required',
        'foto' => 'required',
      ]);
      if($validator->fails()){
        return Response()->json($validator->errors());
      }
      $simpan = barang_model::create([
        'nama_barang' => $req->nama_barang,
        'stok' => $req->stok,
        'foto' => $req->foto,
      ]);
      $status=1;
      $message="Yey Data Berhasil ditambahkan";
      if($simpan){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }

    public function update($id, Request $req){
      $validator = Validator::make($req->all(),
      [
        'nama_barang' => 'required',
        'stok' => 'required',
        'foto' => 'required',
      ]);
      if($validator->fails()){
        return Response()->json($validator->errors());
      }
      $ubah = barang_model::where('id', $id)->update([
        'stok' => $req->stok,
        'nama_barang' => $req->nama_barang,
        'foto' => $req->foto,
      ]);
      $status=1;
      $message="Yey Kamu Berhasil Mengubah Data yang ada";
      if($ubah){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }

    public function tampil(){
      $barang=barang_model::get();
      $count=$barang->count();
      $arr_data=array();
      foreach ($barang as $barang){
        $arr_data[]=array(
          'id' => $barang->id,
          'stok' => $barang->stok,
          'nama_barang' => $barang->nama_barang,
          'foto' => $barang->foto,
        );
      }
      $status=1;
      return Response()->json(compact('status','count','arr_data'));
    }

    public function destroy($id){
      $hapus = barang_model::where('id', $id)->delete();
      $status=1;
      $message="Yey Kamu Berhasil Menghapus Data";
      if($hapus){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }
}
