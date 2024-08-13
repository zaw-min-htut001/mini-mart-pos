<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use App\Models\product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceDataResource;

class InvoiceController extends Controller
{
    //
    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::create([
                'cashier_id' => auth()->id(),
                'total_amount' => 0,
            ]);

            $totalAmount = 0;

            // Add items to the order
            foreach ($request->all() as $item) {
                $product = product::find($item['product_id']);

                $saleItem = SaleItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product->product_id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => 0
                ]);
                $total = $item['quantity'] * $item['unit_price'];

                $totalAmount += $product->unit_price * $item['quantity'];
            }
            $saleItem->update([
                'total_price' => $total,
            ]);
            // Update the order with the total amount
            $invoice->update([
                'total_amount' => $totalAmount,
            ]);
             // Get the current invoice data
            $invoiceData = $this->invoiceData($invoice->id);

            DB::commit();
            return InvoiceDataResource::make($invoiceData);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    protected function invoiceData ($id)
    {
        $data = Invoice::with('saleItems' , 'user' , 'saleItems.product')->find($id);
        return $data;
    }
}
