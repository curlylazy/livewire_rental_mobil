<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

#[Table(name: 'our_services', key: 'kodeour_service', keyType: 'string', incrementing: false)]
#[Unguarded]
class OurServiceModel extends Model
{
    use SoftDeletes, HasUuids;
}
