<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Ürün listesini gösterir
     */
    public function index(Request $request)
    {
        try {
            $query = Product::query();

            // Arama filtresi
            if ($request->has('search')) {
                $search = $request->get('search');
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Kategori filtresi
            if ($request->has('category_id') && $request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            // Tedarikçi filtresi
            if ($request->has('supplier_id') && $request->supplier_id) {
                $query->where('supplier_id', $request->supplier_id);
            }

            // Stok durumu filtresi
            if ($request->has('stock_status')) {
                switch ($request->stock_status) {
                    case 'in_stock':
                        $query->where('stock_quantity', '>', 0);
                        break;
                    case 'out_of_stock':
                        $query->where('stock_quantity', '<=', 0);
                        break;
                    case 'critical':
                        $query->whereColumn('stock_quantity', '<=', 'min_stock_level');
                        break;
                }
            }

            // Durum filtresi
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Sıralama
            $query->orderBy($request->get('sort_by', 'created_at'), $request->get('sort_order', 'desc'));

            $products = $query->paginate(12);
            $categories = Category::where('status', true)->get();
            $suppliers = Supplier::where('status', true)->get();

            return view('products.index', compact('products', 'categories', 'suppliers'));
        } catch (\Exception $e) {
            Log::error('Ürün listesi yüklenirken hata oluştu: ' . $e->getMessage());
            return back()->with('error', 'Ürünler yüklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
        }
    }

    /**
     * Yeni ürün oluşturma formunu gösterir
     */
    public function create()
    {
        $categories = Category::active()->get();
        $suppliers = Supplier::active()->get();
        return view('products.create', compact('categories', 'suppliers'));
    }

    /**
     * Yeni ürün kaydeder
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'sku' => 'nullable|string|max:50|unique:products',
                'barcode' => 'nullable|string|max:50',
                'price' => 'required|numeric|min:0',
                'cost' => 'required|numeric|min:0',
                'tax_rate' => 'required|numeric|min:0|max:100',
                'stock_quantity' => 'required|integer|min:0',
                'min_stock_level' => 'required|integer|min:0',
                'category_id' => 'nullable|exists:categories,id',
                'supplier_id' => 'nullable|exists:suppliers,id',
                'status' => 'boolean',
                'featured' => 'boolean',
                'thumbnail' => 'nullable|image|max:2048',
            ]);

            // Slug oluştur
            $validated['slug'] = Str::slug($validated['name']);

            // Thumbnail varsa yükle
            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('products', 'public');
                $validated['thumbnail'] = $path;
            }

            $product = Product::create($validated);

            Log::info('Yeni ürün oluşturuldu', ['product_id' => $product->id]);
            return redirect()->route('products.index')->with('success', 'Ürün başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            Log::error('Ürün oluşturulurken hata: ' . $e->getMessage());
            return back()->with('error', 'Ürün oluşturulurken bir hata oluştu.')->withInput();
        }
    }

    /**
     * Ürün detaylarını gösterir
     */
    public function show(Product $product)
    {
        $product->load(['category', 'supplier']);
        return view('products.show', compact('product'));
    }

    /**
     * Ürün düzenleme formunu gösterir
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $suppliers = Supplier::active()->get();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Ürün bilgilerini günceller
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'sku' => 'nullable|string|max:50|unique:products,sku,' . $product->id,
                'barcode' => 'nullable|string|max:50',
                'price' => 'required|numeric|min:0',
                'cost' => 'required|numeric|min:0',
                'tax_rate' => 'required|numeric|min:0|max:100',
                'stock_quantity' => 'required|integer|min:0',
                'min_stock_level' => 'required|integer|min:0',
                'category_id' => 'nullable|exists:categories,id',
                'supplier_id' => 'nullable|exists:suppliers,id',
                'status' => 'boolean',
                'featured' => 'boolean',
                'thumbnail' => 'nullable|image|max:2048',
            ]);

            // Slug güncelle
            $validated['slug'] = Str::slug($validated['name']);

            // Yeni thumbnail yüklendiyse eskisini sil ve yenisini yükle
            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
                $path = $request->file('thumbnail')->store('products', 'public');
                $validated['thumbnail'] = $path;
            }

            $product->update($validated);

            Log::info('Ürün güncellendi', ['product_id' => $product->id]);
            return redirect()->route('products.index')->with('success', 'Ürün başarıyla güncellendi.');
        } catch (\Exception $e) {
            Log::error('Ürün güncellenirken hata: ' . $e->getMessage());
            return back()->with('error', 'Ürün güncellenirken bir hata oluştu.')->withInput();
        }
    }

    /**
     * Ürünü siler
     */
    public function destroy(Product $product)
    {
        try {
            // Thumbnail varsa sil
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            $product->delete();

            Log::info('Ürün silindi', ['product_id' => $product->id]);
            return response()->json(['message' => 'Ürün başarıyla silindi.']);
        } catch (\Exception $e) {
            Log::error('Ürün silinirken hata: ' . $e->getMessage());
            return response()->json(['error' => 'Ürün silinirken bir hata oluştu.'], 500);
        }
    }

    /**
     * Ürün durumunu değiştirir (aktif/pasif)
     */
    public function toggleStatus(Product $product)
    {
        try {
            $product->update(['status' => !$product->status]);
            
            Log::info('Ürün durumu değiştirildi', [
                'product_id' => $product->id,
                'new_status' => $product->status
            ]);
            
            return response()->json([
                'message' => 'Ürün durumu başarıyla değiştirildi.',
                'status' => $product->status
            ]);
        } catch (\Exception $e) {
            Log::error('Ürün durumu değiştirilirken hata: ' . $e->getMessage());
            return response()->json(['error' => 'Ürün durumu değiştirilirken bir hata oluştu.'], 500);
        }
    }
} 