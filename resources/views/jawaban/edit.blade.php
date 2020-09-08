@extends('adminlte.master')

@section('content')

<div class="mx-3 pt-3">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Jawaban Kamu (Total Poinmu Saat ini adalah {{$jawaban->poin_jawaban}}) </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
      <form role="form" action="{{route('jawaban.update',['jawaban_id'=>$jawaban->id])}}" method="POST">
            @csrf
            @method('PUT')
          <div class="card-body">
      
            <div class="form-group">
              
            
            <div class="form-group">
              <label for="isi">Isi</label>
              <input type="text" class="form-control" name="isi" value="{{old('isi',$jawaban->isi)}}" id="isi" placeholder="Masukkan pertanyaanmu">
                @error('isi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

          </div>
          <!-- /.card-body -->
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </form>
      </div>
    </div>

@endsection