<?php

namespace App\Http\Controllers;

use App\Models\MasterPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterPlatformController extends Controller
{
    public function getData()
    {
        $master_platform = MasterPlatform::all();
        
        return response()->json([
            'data' => $master_platform
        ]);
    }

    public function index()
    {
        $data['title'] = 'Master Data Platform';
        return view('pages.admin.master.list_platform', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_platform' => 'required|string|unique:master_platform',
            'picture' => 'required|image|mimes:png'
        ],[
            'nama_platform.required' => 'Nama platform harus diisi!',
            'nama_platform.string' => 'Nama platform harus berisi teks!',
            'nama_platform.unique' => 'Nama platform sudah ada!',
            'picture.required' => 'Foto logo platform harus diunggah.',
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
            $picture->move(public_path('assets/media/platforms'), $pictureName);
            
            $master_bank = new MasterPlatform();
            $master_bank->nama_platform = $req->nama_platform;
            $master_bank->picture = $pictureName;
            $master_bank->save();

            return response()->json([
                'message' => 'Berhasil membuat master data platform!'
            ]);
        }
    }

    public function removeChoose(Request $req)
    {
        $data = $req->input('data');
	
        if(!empty($data)){
            foreach ($data as $item) {
                if($item['checkwishId'] !== 'on'){
                    MasterPlatform::where('id', $item['checkwishId'])->delete();
                }
            }

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        }else {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dihapus.']);
        }
    }

    public function remove(Request $req)
    {
        $id = $req->id;

        MasterPlatform::where('id', $id)->delete();

        return response()->json([
            'message' => 'Berhasil menghapus data master platform!'
        ]);
    }
}