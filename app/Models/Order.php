<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'customer_id',
        'status',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'shipping_amount',
        'grand_total',
        'shipping_address',
        'shipping_method',
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
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
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
            self::STATUS_PENDING => 'Beklemede',
            self::STATUS_PROCESSING => 'İşleniyor',
            self::STATUS_COMPLETED => 'Tamamlandı',
            self::STATUS_CANCELLED => 'İptal Edildi',
            default => 'Bilinmiyor',
        };
    }

    /**
     * Siparişe ait müşteriyi getir
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Sipariş kalemlerini getir
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Siparişe ait faturayı getir
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Bekleyen siparişleri filtreler
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * İşlenen siparişleri filtreler
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    /**
     * Tamamlanan siparişleri filtreler
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * İptal edilen siparişleri filtreler
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }
} 