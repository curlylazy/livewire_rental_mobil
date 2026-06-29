<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurServiceModel extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $table = 'our_services';
    protected $guarded = [];
    protected $primaryKey = 'kodeour_service';
    protected $keyType = 'string';
    public $incrementing = false;
}
