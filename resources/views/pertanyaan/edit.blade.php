@extends('adminlte.master')

@section('content')

<div class="mx-3 pt-3">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Post Kamu (Total Poinmu Saat ini adalah {{$pertanyaan->poin_pertanyaan}}) </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
      <form role="form" action="{{route('pertanyaan.update',['pertanyaan'=>$pertanyaan->id])}}" method="POST">
            @csrf
            @method('PUT')
          <div class="card-body">
      
            <div class="form-group">
              <label for="judul">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{old('judul',$pertanyaan->judul)}}" id="judul" placeholder="Masukkan judul">
                @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
              <label for="isi">Isi</label>
              <input type="text" class="form-control" name="isi" value="{{old('isi',$pertanyaan->isi)}}" id="isi" placeholder="Masukkan pertanyaanmu">
                @error('isi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tag">Tags</label>
                <div class=" py-3">                   
                    @forelse($pertanyaan->tag as $tag)
                <button class="btn btn-primary btn-sm">{{$tag->nama_tag}}</button>
                    @empty
                    <p>NO TAGS</p>
                    @endforelse
                </div>
                <input type="text" class="form-control" name="tag" value="{{old('tag',$nama_tag)}}" placeholder="Masukkan tag Baru">
                @error('tag')
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