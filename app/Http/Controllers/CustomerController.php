<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Tüm müşterileri listeler
     */
    public function index()
    {
        try {
            $customers = Customer::orderBy('created_at', 'desc')->paginate(10);
            return view('customers.index', compact('customers'));
        } catch (\Exception $e) {
            Log::error('Müşteri listesi alınırken hata oluştu: ' . $e->getMessage());
            return back()->with('error', 'Müşteriler alınırken bir hata oluştu');
        }
    }

    /**
     * Yeni müşteri kaydı oluşturur
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'tax_number' => 'nullable|string|max:30',
                'notes' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'zip_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:2',
                'status' => 'nullable|string',
                'balance' => 'nullable|numeric',
            ]);

            $customer = Customer::create($validated);
            
            return response()->json([
                'message' => 'Müşteri başarıyla oluşturuldu',
                'customer' => $customer
            ], 201);
        } catch (\Exception $e) {
            Log::error('Müşteri kaydederken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Müşteri kaydedilirken bir hata oluştu'], 500);
        }
    }

    /**
     * Belirtilen müşteriyi gösterir
     */
    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return response()->json(['customer' => $customer]);
        } catch (\Exception $e) {
            Log::error('Müşteri gösterilirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Müşteri bulunamadı'], 404);
        }
    }

    /**
     * Belirtilen müşteriyi günceller
     */
    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'tax_number' => 'nullable|string|max:30',
                'notes' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'zip_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:2',
                'status' => 'nullable|string',
                'balance' => 'nullable|numeric',
            ]);

            $customer->update($validated);
            
            return response()->json([
                'message' => 'Müşteri başarıyla güncellendi',
                'customer' => $customer
            ]);
        } catch (\Exception $e) {
            Log::error('Müşteri güncellenirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Müşteri güncellenirken bir hata oluştu'], 500);
        }
    }

    /**
     * Belirtilen müşteriyi siler
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            
            return response()->json([
                'message' => 'Müşteri başarıyla silindi'
            ]);
        } catch (\Exception $e) {
            Log::error('Müşteri silinirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Müşteri silinirken bir hata oluştu'], 500);
        }
    }
    
    /**
     * Silinen müşterileri listele
     */
    public function trashed()
    {
        try {
            $customers = Customer::onlyTrashed()->orderBy('name')->paginate(10);
            
            return response()->json([
                'success' => true,
                'data' => $customers
            ]);
        } catch (\Exception $e) {
            Log::error('Silinen müşteriler listelenirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Silinen müşteriler listelenirken bir hata oluştu'], 500);
        }
    }
    
    /**
     * Silinen müşteriyi geri getir
     */
    public function restore($id)
    {
        try {
            $customer = Customer::onlyTrashed()->findOrFail($id);
            $customer->restore();
            
            return response()->json([
                'success' => true,
                'message' => 'Müşteri başarıyla geri getirildi',
                'data' => $customer
            ]);
        } catch (\Exception $e) {
            Log::error('Müşteri geri getirilirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Müşteri geri getirilirken bir hata oluştu'], 500);
        }
    }
    
    /**
     * Müşteriyi kalıcı olarak sil
     */
    public function forceDelete($id)
    {
        try {
            $customer = Customer::onlyTrashed()->findOrFail($id);
            $customer->forceDelete();
            
            return response()->json([
                'success' => true,
                'message' => 'Müşteri kalıcı olarak silindi'
            ]);
        } catch (\Exception $e) {
            Log::error('Müşteri kalıcı olarak silinirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Müşteri kalıcı olarak silinirken bir hata oluştu'], 500);
        }
    }
} 