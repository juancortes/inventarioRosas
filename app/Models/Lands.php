<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lands extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $fillable = [
        'name',
        'code'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'lands_id', 'id');
    }

    public function remisiones(): HasMany
    {
        return $this->hasMany(Remisiones::class, 'lands_id', 'id');
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%");
    }
}
