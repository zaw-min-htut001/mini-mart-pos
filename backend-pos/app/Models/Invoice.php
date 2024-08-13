<?php

namespace App\Models;

use App\Models\User;
use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['cashier_id', 'total_amount', 'invoice_id'];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate the invoice ID when creating an order
        static::creating(function ($invoice) {
            $invoice->invoice_id = static::generateInvoiceId();
        });
    }

    public static function generateInvoiceId()
    {
        // Get the latest order's ID to use as a base
        $latestOrder = self::latest()->first();
        $nextId = $latestOrder ? $latestOrder->id + 1 : 1;

        // Format the invoice ID, e.g., 'INV-0001'
        return 'INV-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'cashier_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s a',
        'updated_at' => 'datetime:d/m/Y ',
    ];
}
