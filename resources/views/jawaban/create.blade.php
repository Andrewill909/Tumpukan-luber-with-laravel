@extends('adminlte.master')

@section('content')
    <div class="ml-3 mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Jawaban darimu sangat berarti</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('jawaban.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <input type="text" class="form-control" name="isi" value="{{ old('isi', '') }}" id="isi"
                            placeholder="Masukkan jawabanmu">

                    </div>

                    <input type="hidden" name="id_pertanyaan" value="{{ $id_pertanyaan }}">

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Jawab</button>
                </div>
            </form>
        </div>
    </div>
@endsection
