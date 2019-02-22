<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['preferences'];

    public function dynamic()
    {
        return $this->belongsTo('App\Dynamic');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
