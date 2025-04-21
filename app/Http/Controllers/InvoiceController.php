<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    /**
     * Tüm faturaları listeler
     */
    public function index()
    {
        try {
            $invoices = Invoice::with('customer')->orderBy('created_at', 'desc')->get();
            return response()->json(['invoices' => $invoices]);
        } catch (\Exception $e) {
            Log::error('Fatura listesi alınırken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Faturalar alınırken bir hata oluştu'], 500);
        }
    }

    /**
     * Yeni fatura kaydı oluşturur
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'invoice_number' => 'required|string|max:255|unique:invoices',
                'customer_id' => 'required|exists:customers,id',
                'order_id' => 'nullable|exists:orders,id',
                'status' => ['required', 'string', Rule::in([
                    Invoice::STATUS_DRAFT,
                    Invoice::STATUS_ISSUED,
                    Invoice::STATUS_PAID,
                    Invoice::STATUS_OVERDUE,
                    Invoice::STATUS_CANCELLED
                ])],
                'issue_date' => 'required|date',
                'due_date' => 'required|date|after_or_equal:issue_date',
                'total_amount' => 'required|numeric|min:0',
                'tax_amount' => 'required|numeric|min:0',
                'discount_amount' => 'required|numeric|min:0',
                'grand_total' => 'required|numeric|min:0',
                'payment_method' => 'nullable|string|max:255',
                'payment_status' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $invoice = Invoice::create($validated);
            
            return response()->json([
                'message' => 'Fatura başarıyla oluşturuldu',
                'invoice' => $invoice
            ], 201);
        } catch (\Exception $e) {
            Log::error('Fatura kaydedilirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Fatura kaydedilirken bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Belirtilen faturayı gösterir
     */
    public function show($id)
    {
        try {
            $invoice = Invoice::with(['customer', 'order'])->findOrFail($id);
            return response()->json(['invoice' => $invoice]);
        } catch (\Exception $e) {
            Log::error('Fatura gösterilirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Fatura bulunamadı'], 404);
        }
    }

    /**
     * Belirtilen faturayı günceller
     */
    public function update(Request $request, $id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            
            $validated = $request->validate([
                'invoice_number' => 'sometimes|required|string|max:255|unique:invoices,invoice_number,' . $id,
                'customer_id' => 'sometimes|required|exists:customers,id',
                'order_id' => 'nullable|exists:orders,id',
                'status' => ['sometimes', 'required', 'string', Rule::in([
                    Invoice::STATUS_DRAFT,
                    Invoice::STATUS_ISSUED,
                    Invoice::STATUS_PAID,
                    Invoice::STATUS_OVERDUE,
                    Invoice::STATUS_CANCELLED
                ])],
                'issue_date' => 'sometimes|required|date',
                'due_date' => 'sometimes|required|date|after_or_equal:issue_date',
                'total_amount' => 'sometimes|required|numeric|min:0',
                'tax_amount' => 'sometimes|required|numeric|min:0',
                'discount_amount' => 'sometimes|required|numeric|min:0',
                'grand_total' => 'sometimes|required|numeric|min:0',
                'payment_method' => 'nullable|string|max:255',
                'payment_status' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $invoice->update($validated);
            
            return response()->json([
                'message' => 'Fatura başarıyla güncellendi',
                'invoice' => $invoice
            ]);
        } catch (\Exception $e) {
            Log::error('Fatura güncellenirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Fatura güncellenirken bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Belirtilen faturayı siler
     */
    public function destroy($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            
            // Ödenen bir faturayı silemezsiniz kontrolü
            if ($invoice->status === Invoice::STATUS_PAID) {
                return response()->json(['error' => 'Ödenmiş faturalar silinemez'], 400);
            }
            
            $invoice->delete();
            
            return response()->json([
                'message' => 'Fatura başarıyla silindi'
            ]);
        } catch (\Exception $e) {
            Log::error('Fatura silinirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Fatura silinirken bir hata oluştu'], 500);
        }
    }
    
    /**
     * Faturayı müşteriye gönderir (e-posta gönderimi gibi işlemler burada yapılabilir)
     */
    public function send($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            
            // Taslak durumunda değilse gönderemezsiniz
            if ($invoice->status !== Invoice::STATUS_DRAFT) {
                return response()->json(['error' => 'Yalnızca taslak durumdaki faturalar gönderilebilir'], 400);
            }
            
            // Faturayı düzenlenmiş olarak güncelle
            $invoice->status = Invoice::STATUS_ISSUED;
            $invoice->save();
            
            // Burada e-posta gönderme işlemi yapılabilir
            
            return response()->json([
                'message' => 'Fatura başarıyla gönderildi',
                'invoice' => $invoice
            ]);
        } catch (\Exception $e) {
            Log::error('Fatura gönderilirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Fatura gönderilirken bir hata oluştu'], 500);
        }
    }
    
    /**
     * Faturayı ödenmiş olarak işaretler
     */
    public function markAsPaid($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            
            // İptal edilmiş faturalar ödenemez
            if ($invoice->status === Invoice::STATUS_CANCELLED) {
                return response()->json(['error' => 'İptal edilmiş faturalar ödenemez'], 400);
            }
            
            // Fatura durumunu ödenmiş olarak güncelle
            $invoice->status = Invoice::STATUS_PAID;
            $invoice->payment_status = 'paid';
            $invoice->save();
            
            return response()->json([
                'message' => 'Fatura başarıyla ödendi olarak işaretlendi',
                'invoice' => $invoice
            ]);
        } catch (\Exception $e) {
            Log::error('Fatura ödenmiş olarak işaretlenirken hata oluştu: ' . $e->getMessage());
            return response()->json(['error' => 'Fatura ödenmiş olarak işaretlenirken bir hata oluştu'], 500);
        }
    }
} 