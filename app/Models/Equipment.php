<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Equipment
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $serial_number
 * @property string $category
 * @property string|null $description
 * @property array|null $technical_specifications
 * @property array|null $images
 * @property array|null $manuals
 * @property array|null $msds_documents
 * @property string $risk_level
 * @property bool $requires_supervisor
 * @property string $status
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $purchase_date
 * @property float|null $purchase_price
 * @property \Illuminate\Support\Carbon|null $last_calibration
 * @property \Illuminate\Support\Carbon|null $next_calibration
 * @property \Illuminate\Support\Carbon|null $last_maintenance
 * @property \Illuminate\Support\Carbon|null $next_maintenance
 * @property string|null $usage_notes
 * @property array|null $tags
 * @property string|null $qr_code
 * @property int $laboratory_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Laboratory $laboratory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequestItem> $loanRequestItems
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereRiskLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment available()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment highRisk()
 * @method static \Database\Factories\EquipmentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Equipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'brand',
        'model',
        'serial_number',
        'category',
        'description',
        'technical_specifications',
        'images',
        'manuals',
        'msds_documents',
        'risk_level',
        'requires_supervisor',
        'status',
        'location',
        'purchase_date',
        'purchase_price',
        'last_calibration',
        'next_calibration',
        'last_maintenance',
        'next_maintenance',
        'usage_notes',
        'tags',
        'qr_code',
        'laboratory_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'technical_specifications' => 'array',
        'images' => 'array',
        'manuals' => 'array',
        'msds_documents' => 'array',
        'tags' => 'array',
        'requires_supervisor' => 'boolean',
        'purchase_date' => 'date',
        'purchase_price' => 'decimal:2',
        'last_calibration' => 'date',
        'next_calibration' => 'date',
        'last_maintenance' => 'date',
        'next_maintenance' => 'date',
    ];

    /**
     * Get the laboratory that owns this equipment.
     */
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    /**
     * Get the loan request items for this equipment.
     */
    public function loanRequestItems(): HasMany
    {
        return $this->hasMany(LoanRequestItem::class);
    }

    /**
     * Scope a query to only include available equipment.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope a query to only include high risk equipment.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHighRisk($query)
    {
        return $query->where('risk_level', 'high');
    }

    /**
     * Check if equipment is available for borrowing.
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    /**
     * Check if equipment is high risk.
     */
    public function isHighRisk(): bool
    {
        return $this->risk_level === 'high';
    }
}