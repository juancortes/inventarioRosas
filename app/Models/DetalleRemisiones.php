<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRemisiones extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'remision_id',
        'variety_id',
        'quantity_stems',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function remisiones(): HasMany
    {
        return $this->hasMany(Remisiones::class, 'remision_id', 'id');
    }
}
