@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Proposal KP' => route('admin.proposal-kp.index'),
        'Add' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.proposal-kp.index'), 'icon-list', 'List Proposal KP') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{ Form::open(['route' => 'admin.proposal-kp.store', 'method' => 'post']) }}

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong>Tambah Proposal KP</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul">Judul*</label>
                        {{ Form::text('judul', null, ['class' => 'form-control', 'id' => 'judul', 'placeholder' => 'Judul Proposal']) }}
                    </div>

                    <div class="form-group">
                        <label for="instansi_id">Instansi*</label>
                        {!! Form::select('instansi_id', $instansi, null, ['class' => 'form-control', 'id' => 'instansi_id']) !!}
                    </div>

                    <div class="form-group">
                        <label for="latar_belakang">Latar Belakang*</label>
                        {{ Form::textarea('latar_belakang', null, ['class' => 'form-control', 'id' => 'latar_belakang', 'placeholder' => 'Latar Belakang Proposal']) }}
                    </div>

                    <div class="form-group">
                        <label for="tujuan">Tujuan*</label>
                        {{ Form::textarea('tujuan', null, ['class' => 'form-control', 'id' => 'tujuan', 'placeholder' => 'Tujuan Proposal']) }}
                    </div>

                    <div class="form-group">
                        <label for="usulan_mulai_at">Usulan Mulai*</label>
                        {{ Form::input('date', 'usulan_mulai_at', null, ['class' => 'form-control', 'id' => 'usulan_mulai_at', 'placeholder' => 'Usulan Mulai KP']) }}
                    </div>

                    <div class="form-group">
                        <label for="usulan_selesai_at">Usulan Selesai*</label>
                        {{ Form::input('date', 'usulan_selesai_at', null, ['class' => 'form-control', 'id' => 'usulan_selesai_at', 'placeholder' => 'Usulan Selesai KP']) }}
                    </div>
                    
                    <div class="form-group">
                        <label for="status_proposal">Status Proposal</label>
                        <select name="status_proposal" id="status_proposal" class="form-control" required>
                            <option value="0">Tidak Disetujui</option>
                            <option value="1">Disetujui</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="usulan_selesai_at">Catatan</label>
                        {{ Form::textarea('catatan', null, ['class' => 'form-control', 'id' => 'catatan', 'placeholder' => 'Catatan']) }}
                    </div>
                </div>

                {{--CARD FOOTER--}}
                <div class="card-footer">
                    <p>*Wajib Diisi!</p>
                    <input type="submit" value="Simpan" class="btn btn-primary"/>
                </div>

                {{ Form::close() }}
            </div>

        </div>
    </div>
@endsection
