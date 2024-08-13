<?php

namespace App\Models;

use App\Models\supply;
use App\Models\category;
use App\Models\SaleItem;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $primaryKey = 'product_id';

    public function scopeFilter($query ,$filters)
    {
        if(isset($filters['name']))
        {
            $query->where(function ($searchQuery) use ($filters) {
                $searchQuery->where('name' , 'like' , '%' . $filters['name'] . '%');
            });
        };
        if(isset($filters['category_id']))
        {
            $query->whereHas('category' , function ($catQuery) use ($filters) {
                $catQuery->where('category_id', $filters['category_id']);
            });
        }
        if(isset($filters['brand_id']))
        {
            $query->whereHas('brand' , function ($catQuery) use ($filters) {
                $catQuery->where('brand_id', $filters['brand_id']);
            });
        }
        if(isset($filters['supplier_id']))
        {
            $query->whereHas('supplier' , function ($catQuery) use ($filters) {
                $catQuery->where('supplier_id', $filters['supplier_id']);
            });
        }
    }
    // delete product clear media and file //
    protected static function booted()
    {
        static::deleting(function ($product) {
            // Delete all associated media files
            $product->clearMediaCollection('images');

            // Define the path to the directory
            $directory = storage_path('app/public/images/tmp/'.$product->id);

            // Remove the directory and its contents
            if (File::exists($directory)) {
                File::deleteDirectory($directory);
            }
        });
    }

    protected $fillable = [
        'name' , 'description' , 'brand_id' , 'category_id' ,
        'unit_price' , 'current_stock' , 'supplier_id' , 'unit_of_measure'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y ',
        'updated_at' => 'datetime:d/m/Y ',
    ];

    public function category()
    {
        return $this->belongsTo(category::class , 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(supply::class , 'supplier_id');
    }

    public function brand()
    {
        return $this->belongsTo(brand::class , 'brand_id');
    }

    public function sale()
    {
        return $this->hasMany(SaleItem::class);
    }
}
