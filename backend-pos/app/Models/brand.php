<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'name',
    ];

    public function product()
    {
        return $this->hasMany(product::class . 'product_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y ',
        'updated_at' => 'datetime:d/m/Y ',
    ];
}
