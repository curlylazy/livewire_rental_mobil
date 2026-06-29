<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $guarded = [];
    protected $primaryKey = 'kodegaleri';
    protected $keyType = 'string';
    public $incrementing = false;
}
