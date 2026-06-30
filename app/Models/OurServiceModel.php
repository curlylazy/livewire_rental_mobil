<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

#[Table(name: 'our_services', key: 'kodeour_service', keyType: 'string', incrementing: false)]
#[Unguarded]
class OurServiceModel extends Model
{
    use SoftDeletes, HasUuids;

    public function scopeSearch(Builder $query, string $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('title', 'like', "%$katakunci%")
                ->orWhere('description', 'like', "%$katakunci%");
        });
    }
}
