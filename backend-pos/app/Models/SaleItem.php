<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'total_price','quantity' , 'invoice_id' , 'unit_price'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class , 'product_id');
    }
}
