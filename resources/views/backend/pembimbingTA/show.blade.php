@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Daftar Mahasiswa TA' => route('admin.pembimbingTA.index'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.pembimbingTA.create', [$id]), 'icon-plus', 'Tambah Pembimbing TA') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    Pembimbing TA
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                <div class="form-group">
                <label for="nim">NIM</label>
                {{Form::text('nim', $ta->nim, ['class' => 'form-control-plaintext', 'id' => 'nim', 'readonly' => 'readonly'])}}
                </div>

                <div class="form-group">
                <label for="nama">Nama</label>
                {{Form::text('nama', $ta->nama, ['class' => 'form-control-plaintext', 'id' => 'nama', 'readonly' => 'readonly'])}}
                </div>

                <div class="form-group">
                <label for="judul">Judul TA</label>
                {{Form::text('judul', $ta->judul, ['class' => 'form-control-plaintext', 'id' => 'judul', 'readonly' => 'readonly'])}}
                </div>

                <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        @foreach($pembimbingTAs as $pembimbingTA)
                            <tr>
                                <td>{{ $pembimbingTA->nama }}</td>
                                <td>{{ $pembimbingTA->nip }}</td>
                                <td>
                                @if($pembimbingTA->jabatan=="1")
                                    <p1>Pembimbing Utama</p1>
                                @else
                                    <p1>Pembimbing Pendamping</p1>
                                @endif
                                </td>
                                <td>@if($pembimbingTA->status=="1")
                                    <p1>Diterima</p1>
                                @else
                                    <p1>Batal</p1>
                                @endif
                                <td class="text-center">
                                    {!! cui_btn_delete(route('admin.pembimbingTA.update', [$pembimbingTA->id]), "Yakin ingin membatalkan?") !!}
                                </td>
                            </tr>

                            
                        @endforeach
                        </tbody>
                    </table>

                {{-- CARD FOOTER --}}
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection