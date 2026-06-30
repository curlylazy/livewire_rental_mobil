<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

#[Table(name: 'testimoni', key: 'kodetestimoni', keyType: 'string', incrementing: false)]
#[Unguarded]
class TestimoniModel extends Model
{
    use SoftDeletes, HasUuids;
}
