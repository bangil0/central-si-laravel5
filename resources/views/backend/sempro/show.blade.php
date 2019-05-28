@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'sempro' => route('admin.sempro.index'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn_delete(route('admin.sempro.destroy', [$sempro->id]), $sempro->id, 'icon-trash', 'Hapus Sempro', 'Anda yakin akan menghapus sempro ini?') !!}
    {!! cui_toolbar_btn(route('admin.sempro.index'), 'icon-list', 'List Sempro') !!}
    {!! cui_toolbar_btn(route('admin.sempro.create'), 'icon-plus', 'Tambah Sempro') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    Sempro
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    
                   <div class="form-group">
                        <label for="tugas_akhir_id"><strong>Nama Mahasiswa</strong></label>
                        <p>{{$sempro->nama}}</p>
                    </div>

                    <div class="form-group">
                        <label for="sempro_at"><strong>Tanggal</strong></label>
                        <p>{{$sempro->sempro_at}}</p>
                    </div>

                    <div class="form-group">
                        <label for="sempro_time"><strong>Waktu Sempro</strong></label>
                        <p>{{$sempro->sempro_time}}</p>
                    </div>

                    <div class="form-group">
                        <label for="proposal_status"><strong>Status Proposal</strong></label>
                        <p>{{$sempro->proposal_status}}</p>
                    </div>

                    <div class="form-group">
                        <label for="proposal_status"><strong>Nilai Huruf</strong></label>
                        <p>{{$sempro->nilai_huruf}}</p>
                    </div>


                    <div class="form-group">
                        <label for="nilai_huruf"><strong>Semhas Deadline</strong></label>
                        <p>{{$sempro->semhas_deadline_at}}</p>
                    </div>

                    <div class="form-group">
                    <label for="file_proposal"><strong>File Proposal (PDF)</strong></label>
                    {{ Form::text('file_proposal', null, ['class' => 'form-control-plaintext', 'id' => 'file_proposal', 'readonly' => 'readonly'])}}
                    <a href="{{url('../storage/app/')}}/{{$sempro->file_proposal}}"download="">Download</a>
                    </div>


                    {{ Form::close() }}

                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection