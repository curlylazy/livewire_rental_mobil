<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table(name: 'paket', key: 'kodepaket', keyType: 'string', incrementing: false)]
#[Unguarded]
class PaketModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
}
