<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable = ['ends_at', 'description'];

    protected $dates = ['ends_at', 'created_at', 'updated_at'];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function setEndsAtAttribute($value)
    {
        $this->attributes['ends_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function statusLabel()
    {
        switch ($this->status) {
            case 'closed':
                $color = 'danger';
                $label = 'Cerrado';
                break;

            default:
                $color = 'warning';
                $label = 'Pendiente';
                break;
        }

        return '<span class="badge badge-pill badge-' . $color . '">' . $label . '</span>';
    }
}
