<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'tax_number',
        'tax_office',
        'website',
        'payment_terms',
        'notes',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'payment_terms' => 'integer'
    ];

    /**
     * Get the products associated with the supplier.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the orders associated with the supplier.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the purchases associated with the supplier.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Scope a query to only include active suppliers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get the supplier's full address.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        $parts = [];

        if ($this->address) $parts[] = $this->address;
        if ($this->city) $parts[] = $this->city;
        if ($this->country) $parts[] = $this->country;

        return implode(', ', $parts);
    }
} 