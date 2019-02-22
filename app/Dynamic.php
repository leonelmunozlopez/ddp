<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dynamic extends Model
{
    use SoftDeletes;

    protected $fillable = ['ends_at', 'description'];

    protected $dates = ['ends_at', 'created_at', 'updated_at', 'deleted_at'];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function setEndsAtAttribute($value)
    {
        $this->attributes['ends_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function statusLabel()
    {
        switch ($this->status) {
            case 'open':
                $color = 'primary';
                $label = 'En Votación';
                break;

            case 'closed':
                $color = 'success';
                $label = 'Cerrado';
                break;

            case 'deleted':
                $color = 'dark';
                $label = 'Eliminado';
                break;

            default:
                $color = 'secondary';
                $label = 'Pendiente';
                break;
        }

        return '<span class="badge badge-pill badge-' . $color . '">' . $label . '</span>';
    }
}
