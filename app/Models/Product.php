<?php

namespace App\Models;

use App\Enums\TaxType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public $model = "Producto";

    protected $guarded = ['id'];

    public $fillable = [
        'slug',
        'code',
        'quantity',
        'quantity_alert',
        'buying_price',
        'selling_price',
        'tax',
        'tax_type',
        'notes',
        'product_image',
        'category_id',
        'created_at',
        'updated_at',
        "user_id",
        "uuid",
        "lands_id",
        "branch_stem",
        "type_branche_id",
        "table_id",
        "varietie_id",
        "date",
        "week",
        "consecutive",
        "grades_id"
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tax_type' => TaxType::class,
        //'grades' => Grades::class
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function branch_stem(): BelongsTo
    {
        return $this->belongsTo(BranchStems::class);
    }

    public function typeBranche(): BelongsTo
    {
        return $this->belongsTo(TypeBranches::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Tables::class);
    }

    public function lands(): BelongsTo
    {
        return $this->belongsTo(Lands::class);
    }

    public function varietie(): BelongsTo
    {
        return $this->belongsTo(Varieties::class);
    }

    public function grades(): BelongsTo
    {
        return $this->belongsTo(Grades::class);
    }

    public function remision(): BelongsTo
    {
        return $this->belongsTo(Remisiones::class);
    }

    protected function buyingPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    protected function sellingPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function scopeSearch($query, $value): void
    {
        $query->join('lands','products.lands_id', '=', 'lands.id')
            ->join('varieties','products.varietie_id', '=', 'varieties.id')
            ->join('type_branches','products.type_branche_id', '=','type_branches.id')
            ->join('tables','products.table_id', '=', 'tables.id')
            ->join('grades','products.grades_id', '=', 'grades.id')
            ->where('lands.name', 'ilike', "%{$value}%")
            ->orWhere('varieties.name', 'ilike', "%{$value}%")
            ->orWhere('type_branches.name', 'ilike', "%{$value}%")
            ->orWhere('type_branches.quantity', 'ilike', "%{$value}%")
            ->orWhere('grades.name', 'ilike', "%{$value}%")
            ->orWhere('tables.name', 'ilike', "%{$value}%");
    }
     /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
