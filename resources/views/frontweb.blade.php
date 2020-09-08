@extends('MASTER')
 
@section('content')
  <header class="masthead text-center text-white" >
    <div class="masthead-content">
      <div class="container" >
        <h1 class=" mb-0" style="font-size: 60px">Selamat Datang di Tumpukan Luber</h1>
        <h2 class=" mb-0" style="font-size: 40px">Forum Diskusi Pemograman Terbesar di Indonesia</h2>
      <a href="{{route('pertanyaan.index')}}" class="btn btn-primary btn-xl rounded-pill mt-5">Cek Forum</a>
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
          <img class="img-fluid" src="{{asset('/img/images.PNG')}}" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Apa itu Tumpukan Luber?</h2>
            <p>Tumpukan luber merupakan sebuah wadah khusus bagi programmer di Indonesia untuk berdiskusi mengenai masalah dalam programming</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
          <img class="img-fluid rounded-circle" src="{{asset('/img/stress.PNG')}}" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Latar Belakang</h2>
            <p>Forum ini dibentuk karena kurangnya minat programmer Indonesia untuk belajar coding karena dibatasi oleh keterbatasan bahasa.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
          <img class="img-fluid rounded-circle" src="{{asset('/img/goal.jpg')}}" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Apa Sih Tujuan dari Tumpukan Luber?</h2>
            <p>Tujuan utama tumpukan luber adalah meningkatkan komunitas dan programming di Indonesia dengan sebuah forum yang sederhana namun bermakna</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

