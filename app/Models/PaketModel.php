<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketModel extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $table = 'paket';
    protected $guarded = [];
    protected $primaryKey = 'kodepaket';
    protected $keyType = 'string';
    public $incrementing = false;
}
