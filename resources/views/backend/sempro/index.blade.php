@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sempro' => route('admin.sempro.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.sempro.create'), 'icon-plus', 'Tambah Seminar Proposal') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong>List Seminar Proposal</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                        <div class="row justify-content-end">

                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $sempros->links() }}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Mahasiswa</th>
                            <th class="text-center">Sempro At</th>
                            <th class="text-center">Sempro Time</th>
                            <th class="text-center">Proposal Status</th>
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
                                <td class="text-center">{{ $sempro->semhas_deadline_at }}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.sempro.editnilai', [$sempro->id])}}" class="btn btn-primary">Nilai</a>
                                    {!! cui_btn_view(route('admin.sempro.show', [$sempro->id])) !!}
                                    {!! cui_btn_edit(route('admin.sempro.edit', [$sempro->id])) !!}
                                    {!! cui_btn_delete(route('admin.sempro.destroy', [$sempro->id]), "Anda yakin akan menghapus data sempro ini?") !!}
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Data Seminar Proposal Belum Ada

                                    </td>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">

                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $sempros->links() }}
                            </div>
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
