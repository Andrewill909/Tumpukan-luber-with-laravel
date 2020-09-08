@extends('adminlte.master')
 
@section('content')
<div class="ml-3 mt-3">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Buat Pertanyaan Baru !!</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
  <form role="form" action="{{route('pertanyaan.store')}}" method="POST">
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
          <label for="judul">Judul</label>
        <input type="text" class="form-control" name="judul" value="{{old('title','')}}" id="judul" placeholder="Masukkan judul">
            
           
        </div>
        
        <div class="form-group">
          <label for="isi">Isi</label>
          <input type="text" class="form-control" name="isi" value="{{old('isi','')}}" id="isi" placeholder="Masukkan pertanyaanmu">
            
        </div>

        <div class="form-group">
          <label for="tags">Tag</label>
        <input type="text" class="form-control" name="tags" value="{{old('tags','')}}" id="tags" placeholder="pisahkan tags dengan koma" >

        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Input</button>
      </div>
    </form>
  </div>
</div>
@endsection