<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supply extends Model
{
    use HasFactory;

    protected $primaryKey = 'supplier_id';

    protected $fillable =[
        'name' , 'contact_name' , 'email' , 'phone'
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
