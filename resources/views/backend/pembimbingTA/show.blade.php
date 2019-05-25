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

                <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        @foreach($pembimbingTAs as $pembimbingTA)
                            <tr>
                                <td>{{ $pembimbingTA->nama }}</td>
                                <td>{{ $pembimbingTA->nip }}</td>
                                <td class="text-center">
                                    {!! cui_btn_delete(route('admin.pembimbingTA.show', [$pembimbingTA->id]), "Hapus?") !!}
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