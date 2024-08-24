<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaldosRemisiones extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'remision_id',
        'produccion_freedom',
        'produccion_color',
        'devolucion_freedom',
        "devolucion_color",
        'valor_freedom',
        'valor_color',
        'valor_pagar_freedom',
        'valor_pagar_color',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function remisiones(): BelongsTo
    {
        return $this->belongsTo(Remisiones::class, 'remision_id', 'id');
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('produccion_freedom', 'like', "%{$value}%")
            ->orWhere('produccion_color', 'like', "%{$value}%");
    }

}
