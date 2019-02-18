<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable = ['ends_at', 'description'];

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
