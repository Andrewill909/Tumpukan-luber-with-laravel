<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\pertanyaan;
use App\jawaban;
use App\User;

class JawabanController extends Controller
{
    public function __construct(){

        return $this->middleware('auth');
    }

    public function create($id_pertanyaan)
    {
        return view('jawaban.create',compact('id_pertanyaan'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'isi'=>'required'
        ]);

        $jawaban=jawaban::create([

            'isi'=>$request->isi,
            'pertanyaan_id'=>$request->id_pertanyaan,
            'user_id'=>Auth::id()

        ]);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$request->id_pertanyaan])->with('success','jawaban berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $jawaban=jawaban::where('id',$id)->first();

        return view('jawaban.edit',compact('jawaban'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'isi'=>'required'
        ]);

        $jawaban=jawaban::where('id',$id)->update(['isi'=>$request->isi]);

        $jawaab=jawaban::where('id',$id)->first();
        //dd($jawaab);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$jawaab->pertanyaan_id])->with('success','jawaban berhasil diubah !');
    }

    public function destroy($id)
    {
        $jawaab=jawaban::where('id',$id)->first();
        $id_pertanyaan= $jawaab->pertanyaan_id;

        $jawaban=jawaban::destroy($id);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$id_pertanyaan])->with('success','jawaban berhasil dihapus !');
    }   
    
    public function terbaik($id)
    {
        $jawaban=jawaban::where('id',$id)->first();
        //
        $pertanyaan_id=$jawaban->pertanyaan->id;
        //dd($pertanyaan_id);

        $pertanyaan=pertanyaan::where('id',$pertanyaan_id)->update(['jawaban_terbaik_id'=>$id]);

        $poin=$jawaban->user->reputasi;
        $poin=$poin+15;

        $user=User::where('id',$jawaban->user_id)->update(['reputasi'=>$poin]);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$pertanyaan_id])->with('success','Jawaban Terbaik telah ditambahkan !');
    }

    public function upvote($id)
    {
        $jawaban=jawaban::find($id);

        $id_pertanyaan=$jawaban->pertanyaan_id;

        $id_user=Auth::id();

        //insert ke tabel pivot
        $jawaban->voting()->syncWithoutDetaching([$id_user => ['upvote' => 1]]);

        $upvote=$jawaban->voting()->where('upvote',1)->count();
        $downvote=$jawaban->voting()->where('downvote',1)->count();
        $vote=($upvote*10)-($downvote*5);

        //update ke poin jawaban
        $update=jawaban::where('id',$id)->update(['poin_jawaban' => $vote]);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$id_pertanyaan])->with('success','Upvote telah ditambahkan !');

    }

    public function downvote($id)
    {
        $jawaban=jawaban::find($id);

        $id_pertanyaan=$jawaban->pertanyaan_id;

        $id_user=Auth::id();

        //insert daata ke tabel pivot
        $jawaban->voting()->syncWithoutDetaching([$id_user => ['downvote' => 1]]);

        $upvote=$jawaban->voting()->where('upvote',1)->count();
        $downvote=$jawaban->voting()->where('downvote',1)->count();
        $vote=($upvote*10)-($downvote*5);

        //update ke poin jawaban
        $update=jawaban::where('id',$id)->update(['poin_jawaban' => $vote]);

        return redirect()->route('pertanyaan.show',['pertanyaan'=>$id_pertanyaan])->with('success','Downvote telah ditambahkan !');

    }
}
