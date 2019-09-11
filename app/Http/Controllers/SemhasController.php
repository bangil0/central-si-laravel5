<?php
namespace App\Http\Controllers;
use App\TaSemhas;
use App\Ruangan;
use App\TaSempro;
use DB;
use Illuminate\Http\Request;
class SemhasController extends Controller
{
    public function index()
    {
        $semhass = DB::table('ta_semhas')
                   ->join('ruangan', 'ta_semhas.ruangan_id', '=', 'ruangan.id')
                   ->join('ta_sempro', 'ta_semhas.ta_sempro_id', '=' , 'ta_sempro.id')
                   ->join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
                   ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
                   ->select('ta_semhas.id','ta_semhas.semhas_at','ta_semhas.semhas_time','ruangan.nama','ta_sempro.id','mahasiswa.nama as nama_mahasiswa')
                   ->paginate(25);
        
        return view('backend.semhas.index', compact('semhass'));
    }
    public function create()
    {
      $ruangan = Ruangan::all()->pluck('nama','id');
      $mahasiswa = DB::table('ta_semhas')
                  ->join('ta_sempro', 'ta_semhas.ta_sempro_id', '=' , 'ta_sempro.id')
                  ->join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
                  ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
                  ->select('ta_sempro.id','mahasiswa.nama')
                  ->pluck('mahasiswa.nama','ta_semhas.id');
      $rekomendasi = DB::table('ta_semhas')
                    ->select('rekomendasi', DB::raw('(CASE WHEN rekomendasi = 1 THEN '. "'Mengulang Seminar'" .'WHEN rekomendasi = 2 THEN '. "'Lanjut Sidang dengan Revisi'".'WHEN rekomendasi = 3 THEN '."'Lanjut Sidang Tanpa Revisi'".'END) AS rekomendasi_semhas'))
                    ->distinct()
                    ->pluck('rekomendasi_semhas','rekomendasi');
      return view('backend.semhas.create', compact('ruangan','mahasiswa','rekomendasi'));
    }
    public  function store(Request $request)
    {
        $request->validate([
            'ta_sempro_id'=>'required',
            'semhas_at' => 'required',
            'semhas_time' => 'required',
            'ruangan_id' => 'required',
            'status' => 'required',
            'rekomendasi' => 'required',
            'sidang_deadline_at' => 'required',
            'file_ba_seminar' => 'file|mimes:pdf',
            'file_laporan_ta' => 'file|mimes:pdf',
        ]);
    	      $semhas = new TaSemhas();
            $semhas->ta_sempro_id = $request->input('ta_sempro_id');
            $semhas->semhas_at = $request->input('semhas_at');
            $semhas->semhas_time = $request->input('semhas_time');
            $semhas->ruangan_id = $request->input('ruangan_id');
            $semhas->status = $request->input('status');
            $semhas->rekomendasi = $request->input('rekomendasi');
            $semhas->sidang_deadline_at = $request->input('sidang_deadline_at');
      
          if($request->file('file_ba_seminar')->isValid())
            {
                $filename = uniqid('ba-seminar-');
                $fileext = $request->file('file_ba_seminar')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_ba_seminar->storeAs('/ba_seminar',$filenameext);
                $semhas->file_ba_seminar = $filepath;
            }
            if($request->file('file_laporan_ta')->isValid())
            {
                $filename = uniqid('laporan-');
                $fileext = $request->file('file_laporan_ta')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_laporan_ta->storeAs('/laporan_ta',$filenameext);
                $semhas->file_laporan_ta = $filepath;
            }
            $semhas->save();
      
            return redirect()->route('admin.semhas.show',[$semhas->id]);      
    }
   
    public function edit($id)
    {
        $semhas=TaSemhas::findOrFail($id);
        $ruangan=Ruangan::all()->pluck('nama','id');
        $sempro = DB::table('ta_semhas')
                  ->join('ta_sempro', 'ta_semhas.ta_sempro_id', '=' , 'ta_sempro.id')
                  ->join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
                  ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
                  ->select('mahasiswa.nama as nama','ta_sempro.id')->where('ta_semhas.id',$id)->get();
         $mahasiswa = DB::table('ta_semhas')
                  ->join('ta_sempro', 'ta_semhas.ta_sempro_id', '=' , 'ta_sempro.id')
                  ->join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
                  ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
                  ->select('ta_sempro.id','mahasiswa.nama')
                  ->pluck('mahasiswa.nama','ta_semhas.id');
      $rekomendasi = DB::table('ta_semhas')
                    ->select('rekomendasi', DB::raw('(CASE WHEN rekomendasi = 1 THEN '. "'Mengulang Seminar'" .'WHEN rekomendasi = 2 THEN '. "'Lanjut Sidang dengan Revisi'".'WHEN rekomendasi = 3 THEN '."'Lanjut Sidang Tanpa Revisi'".'END) AS rekomendasi_semhas'))
                    ->distinct()
                    ->pluck('rekomendasi_semhas','rekomendasi');
      return view ('backend.semhas.edit', compact('semhas', 'ruangan','sempro','mahasiswa','rekomendasi','id'));
    }
    public function update (Request $request, $id) {
    $semhas=TaSemhas::findOrFail($id);
        
        $request->validate([
            'ta_sempro_id'=>'required',
            'semhas_at' => 'required',
            'semhas_time' => 'required',
            'ruangan_id' => 'required',
            'rekomendasi' => 'required',
            'sidang_deadline_at' => 'required',
            'file_ba_seminar' => 'file|mimes:pdf',
            'file_laporan_ta' => 'file|mimes:pdf',
        ]);
            $semhas->ta_sempro_id = $request->input('ta_sempro_id');
            $semhas->semhas_at = $request->input('semhas_at');
            $semhas->semhas_time = $request->input('semhas_time');
            $semhas->ruangan_id = $request->input('ruangan_id');
            $semhas->status = $request->input('status');
            $semhas->rekomendasi = $request->input('rekomendasi');
            $semhas->sidang_deadline_at = $request->input('sidang_deadline_at');
            if($request->file('file_ba_seminar')->isValid())
            {
                //hapus file, jika sebelumnya sudah ada
                if (\Storage::exists($semhas->file_ba_seminar)) 
                {
                     \Storage::delete($semhas->file_ba_seminar);
                }
                $filename = uniqid('ba-seminar-');
                $fileext = $request->file('file_ba_seminar')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_ba_seminar->storeAs('/ba_seminar',$filenameext);
                $semhas->file_ba_seminar = $filepath;
            }
            if($request->file('file_laporan_ta')->isValid())
            {
                //hapus file, jika sebelumnya sudah ada
                if (\Storage::exists($semhas->file_laporan_ta)) 
                {
                    # code...
                    \Storage::delete($semhas->file_laporan_ta);
                }
                
                //simpan file yang diupload
                $filename = uniqid('laporan-');
                $fileext = $request->file('file_laporan_ta')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_laporan_ta->storeAs('/laporan_ta',$filenameext);
                $semhas->file_laporan_ta = $filepath;
            }
             if ($semhas->save()) {
                session()->flash('flash_success','Berhasil memperbaharui data semhas');
             //redirect kehalaman detail
                 return redirect()->route('admin.semhas.show', [$semhas->id]);
            }
            return redirect()->route('admin.semhas.show');
    }
    public function show($id)
    {
         $semhass = DB::table('ta_semhas')
                ->join('ruangan', 'ta_semhas.ruangan_id', '=', 'ruangan.id')
                ->join('ta_sempro', 'ta_semhas.ta_sempro_id', '=' , 'ta_sempro.id')
                ->join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
                ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
           
                ->select('ta_sempro.id','mahasiswa.nama','ta_semhas.semhas_at','ta_semhas.semhas_time','ta_semhas.status','ta_semhas.rekomendasi','ta_semhas.sidang_deadline_at','ta_semhas.file_ba_seminar','ta_semhas.file_laporan_ta','ruangan.nama AS ruangan_nama','rekomendasi', DB::raw('(CASE WHEN rekomendasi = 1 THEN '. "'Mengulang Seminar'" .'WHEN rekomendasi = 2 THEN '. "'Lanjut Sidang dengan Revisi'".'WHEN rekomendasi = 3 THEN '."'Lanjut Sidang Tanpa Revisi'".'END) AS rekomendasi_semhas'), 'status', DB::raw('(CASE WHEN status = 1 THEN '. "'Sudah Terlaksana'" .'END) AS status_semhas'))

                ->where('ta_semhas.id','=',$id)
                ->get();
                  

         $semhass = $semhass[0];
  

        return view('backend.semhas.show', compact('semhass','ruangan'));
    }
    public function destroy($id)
    {
        $semhass = DB::table('ta_semhas')
        ->join('ta_peserta_semhas', 'ta_semhas.id', '=', 'ta_peserta_semhas.ta_semhas_id')
        ->join('ta_penguji_semhas', 'ta_semhas.id', '=', 'ta_penguji_semhas.ta_semhas_id')
        ->join('ta_sidang', 'ta_semhas.id', '=', 'ta_sidang.ta_semhas_id')
        ->where('ta_semhas.id','=',$id);
        $semhass->delete();
        session()->flash('flash_success', 'Berhasil menghapus data semhas');
        return redirect()->route('admin.semhas.index');
    }
    
} 