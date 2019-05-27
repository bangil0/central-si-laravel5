<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TaSempro;
use DB;


class SemproController extends Controller
{
	public function index(){
		$sempros = TaSempro::
    					join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
    					->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
    					->select('ta_sempro.*','mahasiswa.nama')
    					->get();

		return view('backend.sempro.index', compact('sempros'));
	}

    public function create()
    {
    	$sempro = TaSempro::all()->pluck('nama','id');
    	$tugas_akhir = TaSempro::
    					join('tugas_akhir','ta_sempro.tugas_akhir_id', '=','tugas_akhir.id')
    					->join('mahasiswa','tugas_akhir.mahasiswa_id','=','mahasiswa.id')
    					->select('tugas_akhir.id','mahasiswa.nama')
    					->pluck('nama');
    	
        return view('backend.sempro.create', compact('sempro','tugas_akhir'));
    }

   	public function store(Request $request)
   {

   	$request->validate([
   		'tugas_akhir_id'=>'required',
   		'sempro_at'=>'required',
   		'sempro_time'=>'required',
   		'proposal_status'=>'required',
   		'file_proposal'=>'file|mimes:pdf'
   	]);

   	$sempro = new TaSempro();
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
   		session()->flash('flash_success','Berhasil Menambahkan Data');
   		return redirect()->route('admin.sempro.index');	
   	}
   	} catch (Exception $e) {
   		session()->flash('flash_error',$e);
   		return redirect()->back();	
   	}
   	
   }

   public function show()
   {

   }
}	   
