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
                        ->paginate(25);
        return view('backend.pembimbingTA.index', compact('pembimbingTAs'));
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
            // $id = DB::getPdo()->lastInsertId();
            // dd($id);
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
                        ->select('ta_pembimbing.id', 'dosen.nama', 'dosen.nip')
                        ->paginate(25);
        // dd($pembimbingTAs);
        return view('backend.pembimbingTA.show', compact('pembimbingTAs', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembimbing = TaPembimbing::findOrFail($id);
        $pembimbing->destroy($id);

        session()->flash('flash_success', 'Berhasil membatalkan pembimbing ');
        return redirect()->route('admin.pembimbingTA.index');
    }
}
