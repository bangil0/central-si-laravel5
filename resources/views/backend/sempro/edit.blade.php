@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'sempro' => route('admin.sempro.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.sempro.create'), 'icon-plus', 'Tambah Data Sempro') !!}
    {!! cui_toolbar_btn(route('admin.sempro.index'), 'icon-list', 'List Data Seminar Proposal') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                {{ Form::model($sempros, ['route' => ['admin.sempro.update', $sempros->id], 'method' => 'patch','files'=>'true']) }}

                {{--CARD HEADER --}}
                <div class="card-header">
                    Edit Data Seminar Proposal
                </div>

                {{-- CARD BODY--}}


            <div class="card-body">
                    @include('backend.sempro._form')
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
