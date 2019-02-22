<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'details'];

    public function dynamic()
    {
        return $this->belongsTo('App\Dynamic');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
