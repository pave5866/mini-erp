<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sku',
        'barcode',
        'price',
        'cost',
        'tax_rate',
        'stock_quantity',
        'min_stock_level',
        'category_id',
        'supplier_id',
        'status',
        'featured',
        'thumbnail',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'cost' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'stock_quantity' => 'integer',
        'min_stock_level' => 'integer',
        'status' => 'boolean',
        'featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Ürünün kategorisini döndürür
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Ürünün tedarikçisini döndürür
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Ürünün sipariş kalemlerini döndürür
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Aktif ürünleri filtreler
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Öne çıkan ürünleri filtreler
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Stok seviyesi minimum seviyenin altındaki ürünleri filtreler
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock_quantity', '<', 'min_stock_level');
    }

    /**
     * Stokta olan ürünleri filtreler
     */
    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    /**
     * Belirli bir kategorideki ürünleri filtreler
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Belirli bir tedarikçinin ürünlerini filtreler
     */
    public function scopeBySupplier($query, $supplierId)
    {
        return $query->where('supplier_id', $supplierId);
    }
} 