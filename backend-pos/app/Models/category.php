<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name'
    ];

    public function product()
    {
        return $this->hasMany(product::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y ',
        'updated_at' => 'datetime:d/m/Y ',
    ];
}
