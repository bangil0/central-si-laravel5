<!-- <<<<<<< yolanda -->
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaSempro; 
use App\User;

class SemproController extends Controller
{
	public $validation_rules = [
		'nilai_huruf' => 'required',
	];

    public function index()
    {

        $sempros = TaSempro::
                        join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
                        ->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
                        ->select('tugas_akhir.id as ta_id','ta_sempro.id','mahasiswa.nama','ta_sempro.sempro_at','ta_sempro.sempro_time','ta_sempro.proposal_status','ta_sempro.nilai_huruf','ta_sempro.semhas_deadline_at')
                        ->paginate(25);
                        // ->pluck('nama');

        // $sempros = TaSempro::findOrFail($id);
     
        return view('backend.sempro.index', compact('sempros'));
    }
    // 	$sempros = TaSempro::paginate(25);
    //     return view('backend.sempro.index', compact('sempros'));
    // } 
     public function create()
    {
     $sempro = TaSempro::all()->pluck('nama','id');
     $tugas_akhir = TaSempro::
         join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
         ->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
         ->select('tugas_akhir.id as tugas_akhir_id','mahasiswa.nama')
         ->pluck('nama', 'tugas_akhir_id');
     
        return view('backend.sempro.create', compact('sempro','tugas_akhir'));
    }
      public function store(Request $request)
   {

    

    $sempro = new TaSempro;
    $sempro->sempro_at = $request->input('sempro_at');
    $sempro->sempro_time = $request->input('sempro_time');
    $sempro->proposal_status = $request->input('proposal_status');
    $sempro->semhas_deadline_at = $request->input('semhas_deadline_at');
    

    $sempro->tugas_akhir_id = $request->input('tugas_akhir_id');

    if($request->file('file_proposal')->isValid())
    {
     $filename = uniqid('proposal-');
     $fileext = $request->file('file_proposal')->extension();
     $filenameext = $filename.'.'.$fileext;

     $filepath = $request->file_proposal->storeAs('sempro_proposal',$filenameext);
     $sempro->file_proposal = $filepath;
    }

    try {
     if($sempro->save()){
    // dd($sempro);
     session()->flash('flash_success','Berhasil Menambahkan Data');
     return redirect()->route('admin.sempro.index'); 
    }
    } catch (Exception $e) {
     session()->flash('flash_error',$e);
     return redirect()->back(); 
    }
    
   }
     
     public function editnilai($id){
        $sempros = TaSempro::
                        join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
                        ->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
                        ->select('tugas_akhir.id as tugas_akhir_id','ta_sempro.id','mahasiswa.nama', 'ta_sempro.nilai_huruf')
                        // ->pluck('nama');
                        ->where('ta_sempro.id', '=',$id)
                        ->get()[0];
    
              return view('backend.sempro.editnilai', compact('sempros'));
    }
    

    public function edit($id){
    	$tugas_akhir = TaSempro::
    					join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
    					->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
    					->select('tugas_akhir.id as tugas_akhir_id','mahasiswa.nama')
    					->pluck('nama','tugas_akhir_id');
    
        $sempros = TaSempro::findOrFail($id);

        return view('backend.sempro.edit', compact('sempros','tugas_akhir'));
    }

     public function updateNilai(Request $request, $id){
        $sempros = TaSempro::where('id',$id)->first();

        $sempros->nilai_huruf = $request->input('nilai_huruf');
                
            try {

                $sempros->update($request->all());


                 session()->flash('flash_success','Berhasil Mengubah Data Nilai');
                 return redirect()->route('admin.sempro.show',[$sempros->id])   ; 
            } catch (Exception $e) {
                 session()->flash('flash_error',$e);
                 return redirect()->back(); 
            }
    }

    public function update(Request $request, $id){
    
    $request->validate([
     'tugas_akhir_id'=>'required',
     'sempro_at'=>'required',
     'sempro_time'=>'required',
     'proposal_status'=>'required',
     // 'file|mimes:pdf'
    ]);

    $sempro = TaSempro::findOrFail($id);
    $sempro->sempro_at = $request->input('sempro_at');
    $sempro->sempro_time = $request->input('sempro_time');
    $sempro->proposal_status = $request->input('proposal_status');
    $sempro->semhas_deadline_at = $request->input('semhas_deadline_at');
    $sempro->tugas_akhir_id = $request->input('tugas_akhir_id');

    if($request->hasFile('file_proposal'))
    {
     $filename = uniqid('proposal-');
     $fileext = $request->file('file_proposal')->extension();
     $filenameext = $filename.'.'.$fileext;

     $filepath = $request->file_proposal->storeAs('sempro_proposal',$filenameext);
     $sempro->file_proposal = $filepath;
    }

	    try {
		     if($sempro->update()){
		     session()->flash('flash_success','Berhasil Mengubah Data');
		     return redirect()->route('admin.sempro.index'); 
	    }
	    } catch (Exception $e) {
		     session()->flash('flash_error',$e);
		     return redirect()->back(); 
	    }

    }
 public function show($id)
    {
     $sempro = TaSempro::
        join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
        ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
        ->select('ta_sempro.*', 'mahasiswa.nama')->where('ta_sempro.id',$id)->first();

    

        return view('backend.sempro.show', compact('sempro'));
    }
     public function destroy(TaSempro $sempro)
    {
     $sempro->delete();
        session()->flash('flash_success', 'Berhasil menghapus data Seminar Proposal  '.$sempro->nama);
        return redirect()->route('admin.sempro.index');
    }
}


   



// =======
// <?php 

// namespace App\Http\Controllers;
// use Illuminate\Http\Request;
// use App\TaSempro;
// use DB;


// class SemproController extends Controller
// {
// 	public function index(){
// 		$sempros = TaSempro::
//     					join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
//     					->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
//     					->select('ta_sempro.*','mahasiswa.nama')
//     					->get();

// 		return view('backend.sempro.index', compact('sempros'));
// 	}

//     public function create()
//     {
//     	$sempro = TaSempro::all()->pluck('nama','id');
//     	$tugas_akhir = TaSempro::
//     					join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
//     					->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
//     					->select('tugas_akhir.id','mahasiswa.nama')
//     					->pluck('nama');
    	
//         return view('backend.sempro.create', compact('sempro','tugas_akhir'));
//     }

//    	public function store(Request $request)
//    {

//    	$request->validate([
//    		'tugas_akhir_id'=>'required',
//    		'sempro_at'=>'required',
//    		'sempro_time'=>'required',
//    		'proposal_status'=>'required',
//    		'file_proposal'=>'file|mimes:pdf'
//    	]);

//    	$sempro = new TaSempro();
//    	$sempro->sempro_at = $request->input('sempro_at');
//    	$sempro->sempro_time = $request->input('sempro_time');
//    	$sempro->proposal_status = $request->input('proposal_status');
//    	$sempro->semhas_deadline_at = $request->input('semhas_deadline_at');
//    	$sempro->tugas_akhir_id = $request->input('tugas_akhir_id');

//    	if($request->file('file_proposal')->isValid())
//    	{
//    		$filename = uniqid('proposal-');
//    		$fileext = $request->file('file_proposal')->extension();
//    		$filenameext = $filename.'.'.$fileext;

//    		$filepath = $request->file_proposal->storeAs('sempro_proposal',$filenameext);
//    		$sempro->file_proposal = $filepath;
//    	}

//    	try {
//    		if($sempro->save()){
//    		session()->flash('flash_success','Berhasil Menambahkan Data');
//    		return redirect()->route('admin.sempro.index');	
//    	}
//    	} catch (Exception $e) {
//    		session()->flash('flash_error',$e);
//    		return redirect()->back();	
//    	}
   	
//    }

//    public function show()
//    {

//    }
// }	   
// >>>>>>> master
