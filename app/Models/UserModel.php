<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Table(name: 'users')]
#[Fillable(['username', 'nama', 'password'])]
#[Hidden(['password', 'remember_token'])]
class UserModel extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable, SoftDeletes;

    public function scopeSearch(Builder $query, string $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('username', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%");
        });
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
