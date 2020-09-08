@extends('adminlte.master')

@section('content')

    <div class="mx-3 pt-3">

        <div class="card">

            <div class="card-header">
                <h3>Jelajahi Seluruh Pertanyaan Dalam Tumpukan Luber</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('pertanyaan.create') }}" class="btn btn-primary btn-sm mb-3">Tambahkan pertanyaan</a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Penulis</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pertanyaan as $p)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $p->judul }}</td>
                                <td>{{ $p->isi }}</td>
                                <td>{{ $p->user->name }}</td>
                                <td style="display: flex" class=" justify-content-between">
                                    <a href="{{ route('pertanyaan.show', ['pertanyaan' => $p->id]) }}"
                                        class="btn btn-info btn-md">Lihat Jawaban</a>
                                    @if (Auth::id() == $p->user->id)

                                        <a href="{{ route('pertanyaan.edit', ['pertanyaan' => $p->id]) }}"
                                            class="btn btn-warning btn-md">Edit</a>
                                        <form action="{{ route('pertanyaan.destroy', ['pertanyaan' => $p->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-danger">Hapus</button>
                                        </form>

                                    @endif

                                </td>
                            @empty
                                <td colspan="4">EMPTY</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
