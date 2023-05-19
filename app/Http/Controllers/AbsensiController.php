<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(REQUEST $request)
    {
        $search = $request->search_nama;
        $limit = $request->limit;
        $Absensi = Absensi::where('nama', 'LIKE', '%'.$search.'%')->limit($limit)->get();
        
        if($Absensi){
            return ApiFormatter::createApi(200, 'success',  $Absensi);
        }else {
        return ApiFormatter::createApi(400, 'failed', $error->getMassage());
        }
    }

    /**
     */
    public function create()
    {
        //
    }

    public function permanenDelete($id)
{

 try {

    $Absensi = Absensi::onlyTrashed()->where('id', $id);
    $proses = $Absensi->forceDelete();
    if($proses){
        return ApiFormatter::createAPI(200, 'succes', 'Data Terhapus permanenen');
            } else{
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch (Exception $error){
            // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
         return ApiForematter::createAPI(400, 'error', $error->getMessage());

    }

 }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data
        try {
            $request->validate([
                'nis' => 'required',
                'nama' => 'required',
                'rombel' => 'required',
                'rayon' => 'required',
                'umur' => 'required',
                'date' => 'required',


            ]);
            
           //mengirim data baru ke table students lewat model students
            $Absensi= Absensi::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'rombel' => $request->rombel,
                'rayon' => $request->rayon,
                'umur' => $request->umur,
                'date' => $request->date,         
    
            ]);
             //cari data barus yang berhasil di simpan, cari berdasarkan id lewat id dari $students yang di atas
         $getDataSaved =Absensi::where('id', $Absensi->id)->first();

         if($getDataSaved){
            return ApiFormatter::createApi(200, 'success',  $getDataSaved);
        }else {
            return ApiFormatter::createApi(400, 'failed',);
        }

     } catch (Exception $error){
        return ApiFormatter::createApi(400, 'failed', $error);
    }
  

}

public function createToken()
    {
    return csrf_token();
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       try {
        //ambil data darib tabel student yang id nya sama kaya $id dari path routnya
       //where dan find fungsi mencari, bedanya where nyari berdasarkan
        $Absensi = Absensi::find($id);
        if ($Absensi){
            //kalau data berhasil diambil, tampilkan data sati $students nya dengan tanda status code 200
            return ApiFormatter::createAPI(200, 'succes', $Absensi);
        }else{
            //kalau data gagal di ambil/data gada, yang di kembalikan status code 400
            return ApiFormatter::createAPI(400, 'failed');
        }
       } catch(Exception $error){
        //kalai pas try ada error, deskripsi errornya di tamilkan statsu coede 400

        return ApiForematter::createAPI(400, 'error', $error->getMessage());
       }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    public function trash()
    {
        try{
            $Absensi = Absensi::onlyTrashed()->get();
            if($Absensi){
                //kalau data berhasil diambil, tampilkan data sati $students nya dengan tanda status code 200
            return ApiFormatter::createAPI(200, 'succes', $Absensi);
        }else{
            //kalau data gagal di ambil/data gada, yang di kembalikan status code 400
            return ApiFormatter::createAPI(400, 'failed');
        }
       } catch(Exception $error){
        //kalai pas try ada error, deskripsi errornya di tamilkan statsu coede 400

        return ApiForematter::createAPI(400, 'error', $error->getMessage());
            
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            //cek validasi inputan pada body postaman
            $request->validate([
                'nis' => 'required',
                'nama' => 'required',
                'rombel' => 'required',
                'rayon' => 'required',
                'umur' => 'required',
                'date' => 'required',

            ]);
            //ambil data yang akan di ubah
            $Absesni = Absensi::find($id);
            //update data yang telah diambil diatas
            $Absensi = Absensi::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'rombel' => $request->rombel,
                'rayon' => $request->rayon,
                'umur' => $request->umur,
                'date' => $request->date,

 
            ]);
            //cari data yang berhasil diubah tadi cari berdasarakn id dari $student yang di ambil di awal
            $dataTerbaru = Absensi::where('id', $Absensi->id)->first();

            if($dataTerbaru){
                //jika update berhasil, tampilkan data dari $updatestudents diatas (data yg sudah berhasil ditambah)
            
            return ApiFormatter::createAPI(200, 'succes', $dataTerbaru);
        } else{
            return ApiFormatter::createAPI(400, 'failed');

        }
    } catch (Exception $error){
        // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
        return ApiFormatter::createAPI(400, 'error', $error->getMessage());

    }
}

public function restore($id)
 {
    try {
        $Absensi = Absensi::onlyTrashed()->where('id', $id);
        $Absensi->restore();
        $dataRestore = Absensi::where('id', $id)->first();
        if($dataRestore){
            //jika update berhasil, tampilkan data dari $updatestudents diatas (data yg sudah berhasil ditambah)
        return ApiFormatter::createAPI(200, 'succes', $dataRestore);
    } else{
        return ApiFormatter::createAPI(400, 'failed');

    }
} catch (Exception $error){
    // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
    return ApiFormatter::createAPI(400, 'error', $error->getMessage());
    }
 }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            //ambil data yang mau di hapus
            $Absensi = Absensi::find($id);
            //hapus data yang ambil di atas
            $cekBerhasil = $Absensi->delete();
            if($cekBerhasil){
                
                return ApiFormatter::createAPI(200, 'succes', 'Data Terhapus');
            } else{
                return ApiFormatter::createAPI(400, 'failed');
    
            }
        } catch (Exception $error){
            // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
            return ApiForematter::createAPI(400, 'error', $error->getMessage());
    
        }
    }
}
