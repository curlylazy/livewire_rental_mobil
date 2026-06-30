<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table(name: 'galeri', key: 'kodegaleri', keyType: 'string', incrementing: false)]
#[Unguarded]
class GaleriModel extends Model
{
    use HasFactory, HasUuids;
}
