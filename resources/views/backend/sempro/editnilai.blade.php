@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'sempro' => route('admin.sempro.index'),
        'Edit Nilai' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.sempro.create'), 'icon-plus', 'Tambah sempro') !!}
    {!! cui_toolbar_btn(route('admin.sempro.index'), 'icon-list', 'List Data Nilai Seminar Proposal') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                {{ Form::model($sempros, ['route' => ['admin.sempro.nilai', $sempros->id], 'method' => 'patch']) }}

                {{--CARD HEADER --}}
                <div class="card-header">
                    Edit Nilai Seminar Proposal
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        {{ Form::text('nama',null, ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'Nama Mahasiswa','readonly' => 'readonly']) }}
                    </div>


                    <div class="form-group">
                        <label for="nilai_huruf">Nilai Huruf</label>
                        {{ Form::SELECT('nilai_huruf', ['A'=>'A','A-'=>'A-', 'B+'=>'B+', 'B'=>'B','B-'=>'B-', 'C+'=>'C+', 'C'=>'C', 'D'=>'D', 'E'=>'E',],null, ['class' => 'form-control', 'id' => 'nilai_huruf', 'placeholder' => 'Nilai Huruf']) }}
                    </div>

            
                    
                </div>


                {{-- CARD FOOTER--}}
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Simpan"/>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
