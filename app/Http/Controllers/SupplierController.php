<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class SupplierController extends Controller
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->middleware('auth');
        $this->middleware('permission:list_suppliers')->only(['index']);
        $this->middleware('permission:view_suppliers')->only(['show']);
        $this->middleware('permission:create_suppliers')->only(['create', 'store']);
        $this->middleware('permission:edit_suppliers')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:delete_suppliers')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Supplier::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%")
                      ->orWhere('contact_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('tax_number', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status === 'active');
            }

            if ($request->filled('payment_terms')) {
                $query->where('payment_terms', $request->payment_terms);
            }

            $suppliers = $query->orderBy($request->sort ?? 'created_at', $request->order ?? 'desc')
                             ->paginate($request->per_page ?? 10);

            return view('suppliers.index', compact('suppliers'));
        } catch (\Exception $e) {
            $this->logger->error('Tedarikçi listesi alınırken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Tedarikçi listesi alınırken bir hata oluştu.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'company_name' => ['required', 'string', 'max:255'],
                'contact_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers'],
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string'],
                'city' => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
                'tax_number' => ['required', 'string', 'max:50', 'unique:suppliers'],
                'tax_office' => ['required', 'string', 'max:100'],
                'website' => ['nullable', 'string', 'max:255', 'url'],
                'payment_terms' => ['required', 'string', 'max:100'],
                'notes' => ['nullable', 'string'],
                'status' => ['boolean']
            ]);

            $validated['status'] = $request->has('status');
            
            $supplier = Supplier::create($validated);

            $this->logger->info('Yeni tedarikçi oluşturuldu', [
                'supplier_id' => $supplier->id,
                'created_by' => auth()->id()
            ]);

            return redirect()->route('suppliers.index')->with('success', 'Tedarikçi başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            $this->logger->error('Tedarikçi oluşturulurken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Tedarikçi oluşturulurken bir hata oluştu.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        try {
            $validated = $request->validate([
                'company_name' => ['required', 'string', 'max:255'],
                'contact_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers,email,' . $supplier->id],
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string'],
                'city' => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
                'tax_number' => ['required', 'string', 'max:50', 'unique:suppliers,tax_number,' . $supplier->id],
                'tax_office' => ['required', 'string', 'max:100'],
                'website' => ['nullable', 'string', 'max:255', 'url'],
                'payment_terms' => ['required', 'string', 'max:100'],
                'notes' => ['nullable', 'string'],
                'status' => ['boolean']
            ]);

            $validated['status'] = $request->has('status');
            
            $supplier->update($validated);

            $this->logger->info('Tedarikçi güncellendi', [
                'supplier_id' => $supplier->id,
                'updated_by' => auth()->id()
            ]);

            return redirect()->route('suppliers.index')->with('success', 'Tedarikçi başarıyla güncellendi.');
        } catch (\Exception $e) {
            $this->logger->error('Tedarikçi güncellenirken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Tedarikçi güncellenirken bir hata oluştu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();

            $this->logger->info('Tedarikçi silindi', [
                'supplier_id' => $supplier->id,
                'deleted_by' => auth()->id()
            ]);

            return back()->with('success', 'Tedarikçi başarıyla silindi.');
        } catch (\Exception $e) {
            $this->logger->error('Tedarikçi silinirken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Tedarikçi silinirken bir hata oluştu.');
        }
    }

    /**
     * Tedarikçileri arayıp filtreleme.
     */
    public function search(Request $request)
    {
        try {
            $query = Supplier::query();
            
            if ($request->has('keyword') && !empty($request->keyword)) {
                $keyword = $request->keyword;
                $query->where(function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%")
                      ->orWhere('phone', 'like', "%{$keyword}%")
                      ->orWhere('tax_id', 'like', "%{$keyword}%");
                });
            }
            
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }
            
            if ($request->has('supplier_type') && !empty($request->supplier_type)) {
                $query->where('supplier_type', $request->supplier_type);
            }
            
            $suppliers = $query->orderBy('created_at', 'desc')->paginate(10);
            
            if ($request->ajax()) {
                return response()->json([
                    'suppliers' => $suppliers,
                    'html' => view('suppliers.partials.supplier_list', compact('suppliers'))->render()
                ]);
            }
            
            return view('suppliers.index', compact('suppliers'));
        } catch (\Exception $e) {
            $this->logger->error('Tedarikçi arama işlemi sırasında hata: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json(['error' => 'Arama sırasında bir hata oluştu.'], 500);
            }
            
            return redirect()->back()->with('error', 'Arama sırasında bir hata oluştu.');
        }
    }
    
    /**
     * Tedarikçi durumunu (aktif/pasif) değiştir.
     */
    public function toggleStatus(Supplier $supplier)
    {
        try {
            $oldStatus = $supplier->status;
            $supplier->update(['status' => !$oldStatus]);

            $statusText = $supplier->status ? 'aktif' : 'pasif';
            $messageType = $supplier->status ? 'success' : 'warning';
            $message = "Tedarikçi durumu {$statusText} olarak güncellendi.";

            $this->logger->info('Tedarikçi durumu değiştirildi', [
                'supplier_id' => $supplier->id,
                'old_status' => $oldStatus,
                'new_status' => $supplier->status,
                'changed_by' => auth()->id()
            ]);

            return back()->with($messageType, $message);
        } catch (\Exception $e) {
            $this->logger->error('Tedarikçi durumu değiştirilirken hata oluştu', [
                'supplier_id' => $supplier->id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Tedarikçi durumu değiştirilirken bir hata oluştu.');
        }
    }
}
