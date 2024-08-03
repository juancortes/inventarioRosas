<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Remisiones extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $fillable = [
        'date',
        'lands_id',
        'variety',
        'quantity_stems',
        'support',
        'observations',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function land(): BelongsTo
    {
        return $this->belongsTo(Lands::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'table_id', 'id');
    }

    public function scopeSearch($query, $value): void
    {
        //$query->where('name', 'like', "%{$value}%");
    }
}
