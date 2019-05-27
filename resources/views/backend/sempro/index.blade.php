@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sempro' => route('admin.sempro.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.sempro.create'), 'icon-plus', 'Tambah Data Sempro') !!}
@endsection

@section('content')
         {{-- CARD HEADER--}}
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD BODY--}}

                  <div class="card-body">
                    List Data Sempro
                </div>

                    <div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Mahasiswa</th>
                            <th class="text-center">Tanggal Sempro</th>
                            <th class="text-center">Waktu Sempro</th>
                            <th class="text-center">Status Proposal</th>
                            <th class="text-center">Nilai Huruf</th>
                            <th class="text-center">Semhas Deadline</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @forelse($sempros as $sempro)
                            <tr>
                                <td class="text-center">{{ $sempro->nama }}</td>
                                <td class="text-center">{{ $sempro->sempro_at }}</td>
                                <td class="text-center">{{ $sempro->sempro_time }}</td>
                                <td class="text-center">{{ $sempro->proposal_status }}</td>
                                <td class="text-center">{{ $sempro->nilai_huruf }}</td>
                                <td class="text-center">{{ $sempro->semhas_deadline_at}}</td>
                                <td class="text-center">
                                
                                    {!! cui_btn_view(route('admin.sempro.show', [$sempro->id])) !!}
                                    {!! cui_btn_edit(route('admin.sempro.edit', [$sempro->id])) !!}
                                    {!! cui_btn_delete(route('admin.sempro.destroy', [$sempro->id]), "Anda yakin akan menghapus data nilai tugas akhir ini?") !!}
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                <h8> Data Sempro Belum Ada </h8>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">
                        </div>
                    </div>
                </div><!--card-body-->

                {{-- CARD FOOTER--}}
                <div class="card-footer">
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection