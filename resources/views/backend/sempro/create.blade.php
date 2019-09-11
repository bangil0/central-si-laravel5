@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sempro' => route('admin.sempro.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.sempro.index'),'List Sempro')!!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                {{ Form::open(['route' => 'admin.sempro.store', 'method' => 'post','files'=>'true']) }}

                {{-- CARD HEADER --}}
                <div class="card-header">
                    Tambah Seminar Proposal
                </div>

                {{-- CARD BODY --}}
                <div class="card-body">
                    @include('backend.sempro._form')
                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer">
                    <input type="submit" value="Simpan" class="btn btn-primary"/>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>


@endsection
