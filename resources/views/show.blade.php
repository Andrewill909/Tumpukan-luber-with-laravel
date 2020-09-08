@extends('adminlte.master')

@section('content')

    <div class="mx-3 pt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">

            <div class="card-header">
                <h3>Detail Pertanyaan</h3>
            </div>

            <div class="card-body">
                <div class=" d-flex">
                    <div class="flex">
                        <div class=" flex-column">
                            <i class="fas fa-user-alt fa-6x border border-black"></i>
                            <h6 class="mt-2" style="text-align: center">{{ $pertanyaan->user->name }}</h6>
                        </div>
                    </div>

                    <div class="flex ml-3">
                        <h4>{{ $pertanyaan->judul }}</h4>
                        <h5>{{ $pertanyaan->isi }}</h5>
                        @forelse($pertanyaan->tag as $tag)

                            <button class="btn btn-secondary">{{ $tag->nama_tag }}</button>
                        @empty

                        @endforelse

                    </div>
                    <div class="flex ml-auto">
                        <p>Total poin: {{ $pertanyaan->poin_pertanyaan }}</p>
                        <a href="{{ route('pertanyaan.upvote', ['id' => $pertanyaan->id]) }}"
                            class="btn btn-success">Upvote</a>
                        <a href="{{ route('pertanyaan.downvote', ['id' => $pertanyaan->id]) }}"
                            class="btn btn-danger">Downvote</a>

                    </div>
                </div>

            </div>

        </div>

        <div class="py-3">
            <a href="{{ route('jawaban.create', ['id_pertanyaan' => $pertanyaan->id]) }}" class="btn btn-primary">Tambahkan
                Jawaban</a>
        </div>


    </div>

    @if ($pertanyaan->jawaban_terbaik_id)
        <div class="mx-3 pt-3">

            <div class="card bg-warning">

                <div class="card-header">

                    <h3>Jawaban Terbaik</h3>

                </div>
                <div class="card-body">
                    <div class="d-flex">

                        <div>
                            <div class=" flex-column">
                                <i class="fas fa-user-alt fa-6x border border-black"></i>
                                <h6 class="mt-2" style="text-align: center">{{ $pertanyaan->terbaik->user->name }}</h6>
                            </div>
                        </div>

                        <div class=" ml-3">
                            <h5>{{ $pertanyaan->terbaik->isi }}</h5>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    @endif


    <div class="mx-3 pt-3">

        <div class="card">

            <div class="card-header">
                <h3>Semua Jawaban</h3>
            </div>

            @forelse($jawaban as $jawab)

                <div class="card-body border-bottom">
                    <div class=" d-flex">
                        <div>
                            <div class=" flex-column">
                                <i class="fas fa-user-alt fa-6x border border-black"></i>
                                <h6 class="mt-2" style="text-align: center">{{ $jawab->user->name }}</h6>
                            </div>
                        </div>

                        <div class=" ml-3">
                            <h5>{{ $jawab->isi }}</h5>
                            <p>Poin Jawaban: {{ $jawab->poin_jawaban }}</p>
                        </div>

                        <div class="ml-auto d-flex-column">
                            <div class=" d-inline-flex pb-3">
                                @if (Auth::id() == $jawab->user->id)
                                    <div class="pr-2">
                                        <a href="{{ route('jawaban.edit', ['jawaban_id' => $jawab->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    </div>
                                    @if (empty($jawab->pertanyaan_terbaik->jawaban_terbaik_id))
                                        <form action="{{ route('jawaban.destroy', ['jawaban_id' => $jawab->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="pr-2">
                                                <button type="submit" class="btn btn-md btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            </div>
                            @if ($pertanyaan->user_id == Auth::id() && !$pertanyaan->jawaban_terbaik_id)
                                <div>
                                    <a href="{{ route('jawaban.terbaik', ['jawaban_id' => $jawab->id]) }}"
                                        class="btn btn-warning btn-md">Jadikan Jawaban Terbaik</a>

                                </div>
                            @endif
                            <div class="pt-3 allign-bottom">
                                <a href="{{ route('jawaban.upvote', ['id' => $jawab->id]) }}" class="btn btn-success">Upvote</a>
                                <a href="{{ route('jawaban.downvote', ['id' => $jawab->id]) }}"
                                    class="btn btn-danger">Downvote</a>
                            </div>
                        </div>

                    </div>

                </div>

            @empty
                <h5>Belum ada Jawaban</h5>

            @endforelse

        </div>

    </div>

@endsection
