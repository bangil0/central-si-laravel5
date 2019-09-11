@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'PembimbingTA' => route('admin.pembimbingTA.index'),
        'Index' => '#'
    ]) !!}
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
                            <th>Jumlah Pembimbing</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <?php $i=0; ?>
                        @foreach($pembimbingTAs as $pembimbingTA)
                            <tr>
                                <td>{{ $pembimbingTA->nim }}</td>
                                <td>{{ $pembimbingTA->nama }}</td>
                                <td>{{ $pembimbingTA->judul }}</td>
                                @if($jumlah[$i]->jumlah == null)
                                <td>0</td>
                                @else
                                <td>{{ $jumlah[$i]->jumlah }}</td>
                                @endif
                                <?php $i++; ?>
                                <td class="text-center">
                                {!! cui_btn_view(route('admin.pembimbingTA.destroy', [$pembimbingTA->id]) ) !!}
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
 