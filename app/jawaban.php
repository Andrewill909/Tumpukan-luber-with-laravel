<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    protected $table="jawaban";

    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo('App\user','user_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\pertanyaan','pertanyaan_id');
    }

    public function pertanyaan_terbaik()
    {
        return $this->hasOne('App\pertanyaan','jawaban_terbaik_id');
    }

    public function voting()
    {
        return $this->belongsToMany('App\User','voting_jawaban','jawaban_id','user_id')->withPivot('upvote','downvote')->withTimestamps();
    }
}
