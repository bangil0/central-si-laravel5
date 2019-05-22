@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'PembimbingTA' => route('admin.pembimbingTA.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.pembimbingTA.create'), 'icon-plus', 'Tambah PembimbingTA') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong>List Mahasiswa</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">
                            <form method="post" action="{{ route('admin.dosencari.show') }}" class="form-inline">
                                {{ csrf_field() }}
                                <input type="text" name="keyword" class="form-control" value="@if(isset($keyword)) {{ $keyword }} @endif" placeholder="Masukkan Keyword" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Cari" />
                            </form>
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $pembimbingTAs ->links() }}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Judul TA</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembimbingTAs as $pembimbingTA)
                            <tr>
                                <td>{{ $pembimbingTA->nim }}</td>
                                <td>{{ $pembimbingTA->nama }}</td>
                                <td>{{ $pembimbingTA->judul }}</td>
                                <td class="text-center">
                                    {!! cui_btn_view(route('admin.pembimbingTA.show', [$pembimbingTA->id])) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">

                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $pembimbingTAs->links() }}
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
