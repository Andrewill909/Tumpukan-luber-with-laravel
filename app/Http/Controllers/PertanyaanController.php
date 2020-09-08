<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\pertanyaan; 
use App\tag;
use App\jawaban;
use App\User;
use Auth;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        //bisa pakai ->only juga
    }


    public function index()
    {
        //mengambil semua data dari tabel pertanyaan pada database
        $pertanyaan=pertanyaan::all();
        $nomor=1;
        //dd($pertanyaan);

        return view('pertanyaan.index',compact('pertanyaan','nomor'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $isi_tag=explode(',',$request->tags);
        $tag_ids=[];

        foreach($isi_tag as $nama_tag)
        {
            //insert ke database tabel tag
            $tag=tag::firstOrCreate(['nama_tag'=>$nama_tag]);
            $tag_ids[]= $tag->id;
            
        }
        //dd($tag_ids);
        $request->validate([
            'judul' => 'required|unique:pertanyaan',
            'isi'=>'required'            
        ]); 

        //insert ke database tabel pertanyaan
        $pertanyaan=pertanyaan::create([
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'user_id'=>Auth::id()
            ]);

        //insert ke database tabel pertanyaan_tag
        $pertanyaan->tag()->sync($tag_ids);

        return redirect('/pertanyaan')->with('success','Perubahan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan=pertanyaan::find($id);

        $jawaban=$pertanyaan->jawaban;
        //dd($jawaban->first()->pertanyaan_terbaik->jawaban_terbaik_id);

        return view('show',compact('pertanyaan','jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan=pertanyaan::where('id',$id)->first();
        //dd($pertanyaan->tag);
        //dd($pertanyaan->tag);

        //konversi nama tag menjadi format koma
        $nama_tag=[];
        foreach($pertanyaan->tag as $tag)
        {
            $nama_tag[]=$tag->nama_tag;
        }

        $nama_tag= implode(',',$nama_tag);

        //dd($nama_tag);

        return view('pertanyaan.edit', compact('pertanyaan','nama_tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);

        $request->validate([
            'judul' => 'required|unique:pertanyaan',
            'isi'=>'required'
        ]);
            //upfate ke database tabel pertanyaan
        $pertanyaan= pertanyaan::where('id',$id)->update(['judul'=>$request->judul,'isi'=>$request->isi]);

        //jika diinputkna tag baru
        if($request->tag)
        {
            $isi_tag=explode(',',$request->tag);
            $tag_ids=[];

             //update ke database tabel tag
            foreach($isi_tag as $nama_tag)
            {
            //insert ke database tabel tag
            $tag=tag::firstOrCreate(['nama_tag'=>$nama_tag]);
            $tag_ids[]= $tag->id;
            
            }

            //update ke database tabel pertanyaan_tag
            $id_pertanyaan=pertanyaan::find($id);
            $id_pertanyaan->tag()->sync($tag_ids);
        }
        
        


        return redirect('/pertanyaan')->with('success','Perubahan Berhasil Dilakukan !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan=pertanyaan::destroy($id);
        return redirect('/pertanyaan')->with('success','Data Berhasil Dihapus !');
    }

    public function upvote($id)
    {
        $pertanyaan=pertanyaan::find($id);
        $id_user=Auth::id();

        //masukan data ke tablek pivot
        $pertanyaan->voting()->syncWithoutDetaching([$id_user => ['upvote' => 1]]);

        //update poin pertanyaan

        $poin_up=$pertanyaan->voting()->where('upvote',1)->count();
        $poin_down=$pertanyaan->voting()->where('downvote',1)->count();
        $poin=($poin_up*10)-($poin_down*5);

        $update=pertanyaan::where('id',$id)->update(['poin_pertanyaan' => $poin]);



        return redirect()->route('pertanyaan.show',['pertanyaan'=>$id])->with('success','Upvote telah ditambahkan !');
    }

    public function downvote($id)
    {
        $pertanyaan=pertanyaan::find($id);
        $id_user=Auth::id();

        //masukkan data ke tabel pivot
        $pertanyaan->voting()->syncWithoutDetaching([$id_user => ['downvote' => 1]]);

        $poin_up=$pertanyaan->voting()->where('upvote',1)->count();
        $poin_down=$pertanyaan->voting()->where('downvote',1)->count();
        $poin=($poin_up*10)-($poin_down*5);

        $update=pertanyaan::where('id',$id)->update(['poin_pertanyaan' => $poin]);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$id])->with('success','Downvote telah ditambahkan !');
    }
}
