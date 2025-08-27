<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LoanRequest
 *
 * @property int $id
 * @property string $request_number
 * @property int $user_id
 * @property int $laboratory_id
 * @property \Illuminate\Support\Carbon $start_datetime
 * @property \Illuminate\Support\Carbon $end_datetime
 * @property string $purpose
 * @property string|null $jsa_document
 * @property string $status
 * @property int|null $lecturer_supervisor_id
 * @property \Illuminate\Support\Carbon|null $lecturer_approved_at
 * @property string|null $lecturer_notes
 * @property int|null $lab_approved_by
 * @property \Illuminate\Support\Carbon|null $lab_approved_at
 * @property string|null $lab_notes
 * @property string|null $rejection_reason
 * @property \Illuminate\Support\Carbon|null $checked_out_at
 * @property int|null $checked_out_by
 * @property \Illuminate\Support\Carbon|null $returned_at
 * @property int|null $returned_to
 * @property array|null $checkout_condition_notes
 * @property array|null $return_condition_notes
 * @property array|null $checkout_photos
 * @property array|null $return_photos
 * @property float $fine_amount
 * @property string|null $fine_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Laboratory $laboratory
 * @property-read \App\Models\User|null $lecturerSupervisor
 * @property-read \App\Models\User|null $labApprover
 * @property-read \App\Models\User|null $checkedOutBy
 * @property-read \App\Models\User|null $returnedTo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequestItem> $items
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereRequestNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest pending()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest approved()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest overdue()
 * @method static \Database\Factories\LoanRequestFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class LoanRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'request_number',
        'user_id',
        'laboratory_id',
        'start_datetime',
        'end_datetime',
        'purpose',
        'jsa_document',
        'status',
        'lecturer_supervisor_id',
        'lecturer_approved_at',
        'lecturer_notes',
        'lab_approved_by',
        'lab_approved_at',
        'lab_notes',
        'rejection_reason',
        'fine_amount',
        'fine_reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'lecturer_approved_at' => 'datetime',
        'lab_approved_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'returned_at' => 'datetime',
        'checkout_condition_notes' => 'array',
        'return_condition_notes' => 'array',
        'checkout_photos' => 'array',
        'return_photos' => 'array',
        'fine_amount' => 'decimal:2',
    ];

    /**
     * Get the user who made this loan request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the laboratory for this loan request.
     */
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    /**
     * Get the lecturer supervisor for this loan request.
     */
    public function lecturerSupervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lecturer_supervisor_id');
    }

    /**
     * Get the lab staff who approved this request.
     */
    public function labApprover(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lab_approved_by');
    }

    /**
     * Get the staff who checked out this request.
     */
    public function checkedOutBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    /**
     * Get the staff who received the return.
     */
    public function returnedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'returned_to');
    }

    /**
     * Get the items in this loan request.
     */
    public function items(): HasMany
    {
        return $this->hasMany(LoanRequestItem::class);
    }

    /**
     * Scope a query to only include pending requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->whereIn('status', ['submitted', 'awaiting_lecturer_approval', 'awaiting_lab_approval']);
    }

    /**
     * Scope a query to only include approved requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include overdue requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }

    /**
     * Generate a unique request number.
     */
    public static function generateRequestNumber(): string
    {
        $prefix = 'CR-' . date('Y') . '-';
        $lastRequest = static::where('request_number', 'like', $prefix . '%')
            ->orderBy('request_number', 'desc')
            ->first();

        if ($lastRequest) {
            $lastNumber = (int) substr($lastRequest->request_number, strlen($prefix));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . str_pad((string) $nextNumber, 6, '0', STR_PAD_LEFT);
    }
}