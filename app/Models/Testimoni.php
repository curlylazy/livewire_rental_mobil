<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $guarded = [];
    protected $primaryKey = 'kodetestimoni';
    protected $keyType = 'string';
    public $incrementing = false;
}
