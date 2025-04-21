<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_DRAFT = 'draft';
    const STATUS_ISSUED = 'issued';
    const STATUS_PAID = 'paid';
    const STATUS_OVERDUE = 'overdue';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'order_id',
        'status',
        'issue_date',
        'due_date',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'grand_total',
        'payment_method',
        'payment_status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'created_date',
        'status_label',
    ];

    /**
     * Oluşturulma tarihini formatlanmış şekilde döndürür.
     */
    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    /**
     * Durum etiketini döndürür.
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'Taslak',
            self::STATUS_ISSUED => 'Düzenlendi',
            self::STATUS_PAID => 'Ödendi',
            self::STATUS_OVERDUE => 'Gecikmiş',
            self::STATUS_CANCELLED => 'İptal Edildi',
            default => 'Bilinmiyor',
        };
    }

    /**
     * Faturaya ait müşteriyi getir
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Faturaya ait siparişi getir
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Taslak faturaları filtreler
     */
    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    /**
     * Düzenlenmiş faturaları filtreler
     */
    public function scopeIssued($query)
    {
        return $query->where('status', self::STATUS_ISSUED);
    }

    /**
     * Ödenmiş faturaları filtreler
     */
    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    /**
     * Gecikmiş faturaları filtreler
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', self::STATUS_OVERDUE);
    }

    /**
     * İptal edilmiş faturaları filtreler
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }
} 