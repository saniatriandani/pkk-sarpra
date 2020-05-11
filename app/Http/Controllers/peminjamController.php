<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\peminjam_model;
use Auth;
use Illuminate\Support\Facades\Validator;
class peminjamController extends Controller
{
    public function index()
    {
        if(Auth::user()->level=="admin"){
            $dt_peminjam=peminjam_model::get();
            return response()->json($dt_peminjam);
        }else{
            return response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin"){
            $validator=Validator::make($req->all(),
            [
                'nama_peminjam'=>'required',
                'alamat'=>'required',
                'telp'=>'required'
            ]
            );
            if($validator->fails()){
                return Response()->json($validator->errors());
            }

            $simpan=peminjam_model::create([
                'nama_peminjam'=>$req->nama_peminjam,
                'alamat'=>$req->alamat,
                'telp'=>$req->telp
            ]);
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
    }
    public function update($id,Request $req)
    {
        if(Auth::user()->level=='admin'){
            $validator=Validator::make($req->all(),
            [
                'nama_peminjam'=>'required',
                'alamat'=>'required',
                'telp'=>'required'
            ]
            );
            if($validator->fails()){
                return Response()->json($validator->errors());
            }
            $ubah=peminjam_model::where('id', $id)->update([
                'nama_peminjam'=>$req->nama_peminjam,
                'alamat'=>$req->alamat,
                'telp'=>$req->telp
            ]);
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        if(Auth::user()->level=='admin'){
            $hapus=peminjam_model::where('id', $id)->delete();
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil(){
        if(Auth::user()->level=='admin'){
            $datas = peminjam_model::get();
            $count = $datas->count();
            $peminjam = array();
            $status = 1;
            foreach ($datas as $dt_gt){
                $peminjam[] = array(
                    'nama_peminjam' => $dt_gt->nama_peminjam,
                    'alamat' => $dt_gt->alamat,
                    'telp' => $dt_gt->telp
                );
            }
            return Response()->json(compact('count','peminjam'));
        }else{
            return Response()->json(['status'=> 'Tidak Bisa Anda Bukan Admin']);
        }
    }
}
