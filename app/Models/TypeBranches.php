<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeBranches extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $fillable = [
        'name',
        'code',
        'quantity'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'type_branche_id', 'id');
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%");
    }
}
