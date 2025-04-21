<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Kitle atanabilir alanlar.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'tax_number',
        'balance',
        'status',
        'notes',
    ];

    /**
     * Tip dönüşümleri.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'balance' => 'decimal:2',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'created_date',
    ];

    /**
     * Oluşturulma tarihini formatlanmış şekilde döndürür.
     */
    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    /**
     * Müşteriye ait siparişleri getir
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Müşteriye ait faturaları alır.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Aktif müşterileri filtreler
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Pasif müşterileri filtreler
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }
} 