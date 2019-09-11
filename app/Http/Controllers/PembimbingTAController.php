<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaPembimbing;
use App\TugasAkhir;
use App\Dosen;
use DB;

class PembimbingTAController extends Controller
{
    public $validation_rules = [
        'dosen_id' => 'required|nama',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembimbingTAs = TugasAkhir::
                        join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
                        ->select('tugas_akhir.id', 'mahasiswa.nama','tugas_akhir.judul','mahasiswa.nim')
                        ->paginate(25);
        $jumlah = TaPembimbing::select('tugas_akhir_id', DB::raw('
                        sum(ta_pembimbing.status) as jumlah
                        '))
                        ->rightJoin('tugas_akhir', 'tugas_akhir.id', '=', 'ta_pembimbing.tugas_akhir_id')
                        ->groupBy('tugas_akhir.id')
                        ->get();
        return view('backend.pembimbingTA.index', compact('pembimbingTAs', 'jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pembimbing = Dosen::pluck('nama', 'id');
        return view('backend.pembimbingTA.create', compact('pembimbing', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'dosen_id' => 'required'
       ]);
            $pembimbing = new TaPembimbing();
            $pembimbing->dosen_id = $request->input('dosen_id');
            $pembimbing->tugas_akhir_id = $request->input('tugas_akhir_id');
            $pembimbing->jabatan = $request->input('jabatan');
            $pembimbing->status = $request->input('status');

            $pembimbing->save();
            session() ->flash('flash_success', 'Berhasil menambahkan pembimbing');
        
            $id =TaPembimbing::all()->last()->id;
            return redirect()->route('admin.pembimbingTA.show', [$pembimbing->tugas_akhir_id]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembimbingTAs = DB::table('ta_pembimbing')
                        ->join('dosen', 'ta_pembimbing.dosen_id', '=', 'dosen.id')
                        ->join('tugas_akhir', 'tugas_akhir.id', '=', 'ta_pembimbing.tugas_akhir_id')
                        ->where('tugas_akhir.id', '=', $id)
                        ->select('ta_pembimbing.id', 'dosen.nama', 'dosen.nip','ta_pembimbing.jabatan','ta_pembimbing.status')
                        ->paginate(25);
    
        $ta =DB :: table('tugas_akhir')
                ->join('mahasiswa','mahasiswa.id', '=', 'tugas_akhir.mahasiswa_id')
                ->select('mahasiswa.nama','mahasiswa.nim','tugas_akhir.judul')
                ->where('tugas_akhir.id','=',$id)
                ->get()[0];

        return view('backend.pembimbingTA.show', compact('pembimbingTAs', 'id', 'ta' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {   
        $pembimbing = TaPembimbing::findOrFail($id);
        $data['status'] = 0;
        $pembimbing->update($data);
        session()->flash('flash_success', 'Berhasil membatalkan pembimbing ');

        return redirect()->route('admin.pembimbingTA.index');
    }
}
