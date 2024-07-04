<?php

namespace App\Http\Controllers;

use App\Models\MasterBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterBankController extends Controller
{
    public function getData()
    {
        $master_bank = MasterBank::all();
        return response()->json([
            'data' => $master_bank
        ]);
    }

    public function index()
    {
        $data['title'] = 'Master Data Bank';
        return view('pages.admin.master.list_bank', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_bank' => 'required|string|unique:master_bank',
            'picture' => 'required|image|mimes:png'
        ],[
            'nama_bank.required' => 'Nama bank harus diisi!',
            'nama_bank.string' => 'Nama bank harus berisi teks!',
            'nama_bank.unique' => 'Nama bank sudah ada!',
            'picture.required' => 'Foto logo bank harus diunggah.',
            'picture.image' => 'File yang diunggah harus berupa gambar.',
            'picture.mimes' => 'Format gambar yang diizinkan hanya: png',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $picture = $req->file('picture');
            $pictureName = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('assets/images/banks'), $pictureName);
            
            $master_bank = new MasterBank();
            $master_bank->nama_bank = $req->nama_bank;
            $master_bank->picture = $pictureName;
            $master_bank->save();

            return response()->json([
                'message' => 'Berhasil membuat master data bank!'
            ]);
        }
    }

    public function removeChoose(Request $req)
    {
        $data = $req->input('data');
	
        if(!empty($data)){
            foreach ($data as $item) {
                if($item['checkwishId'] !== 'on'){
                    MasterBank::where('id', $item['checkwishId'])->delete();
                }
            }

            return response()->json(['success' => true, 'message' => 'Data berhasil dikirim.']);
        }else {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dikirim.']);
        }
    }

    public function remove(Request $req)
    {
        $id = $req->id;

        MasterBank::where('id', $id)->delete();

        return response()->json([
            'message' => 'Berhasil menghapus data master bank!'
        ]);
    }
}
