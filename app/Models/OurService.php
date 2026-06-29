<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $guarded = [];
    protected $primaryKey = 'kodeour_service';
    protected $keyType = 'string';
    public $incrementing = false;
}
