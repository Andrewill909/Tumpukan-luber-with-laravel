<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    protected $table="pertanyaan";

    protected $guarded=[];

    //satu user punya banyak pertanyaan
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function tag()
    {
        return $this->belongsToMany('App\tag','pertanyaan_tag','pertanyaan_id','tag_id');
    }

    public function jawaban()
    {
        return $this->hasMany('App\jawaban','pertanyaan_id');
    }

    public function terbaik()
    {
        return $this->belongsTo('App\jawaban','jawaban_terbaik_id');
    }

    public function voting()
    {
        return $this->belongsToMany('App\User','voting_pertanyaan','pertanyaan_id','user_id')->withPivot('upvote','downvote')->withTimeStamps();
    }
}
