<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriModel extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $table = 'galeri';
    protected $guarded = [];
    protected $primaryKey = 'kodegaleri';
    protected $keyType = 'string';
    public $incrementing = false;
}
