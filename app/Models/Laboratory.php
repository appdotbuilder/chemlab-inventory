<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Laboratory
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property string $location
 * @property int $capacity
 * @property array $operating_hours
 * @property array|null $blackout_dates
 * @property string|null $contact_person
 * @property string|null $contact_email
 * @property string|null $contact_phone
 * @property array|null $image_gallery
 * @property array|null $sop_documents
 * @property string|null $rules
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equipment> $equipment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequest> $loanRequests
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory active()
 * @method static \Database\Factories\LaboratoryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Laboratory extends Model
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
        'description',
        'location',
        'capacity',
        'operating_hours',
        'blackout_dates',
        'contact_person',
        'contact_email',
        'contact_phone',
        'image_gallery',
        'sop_documents',
        'rules',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'operating_hours' => 'array',
        'blackout_dates' => 'array',
        'image_gallery' => 'array',
        'sop_documents' => 'array',
        'capacity' => 'integer',
    ];

    /**
     * Get the equipment belonging to this laboratory.
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Get the loan requests for this laboratory.
     */
    public function loanRequests(): HasMany
    {
        return $this->hasMany(LoanRequest::class);
    }

    /**
     * Scope a query to only include active laboratories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}