<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\supply;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    //
    public function index(ProductDataTable $dataTable)
    {

        $brands = brand::all();
        $categories = category::all();
        $suppliers = supply::all();

        return $dataTable->render('pos.product' , [
            'brands' => $brands ,
            'categories' => $categories ,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * create products
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required' ,
            'brand_id' => 'required' ,
            'category_id' => 'required' ,
            'unit_price' => 'required' ,
            'current_stock' => 'required' ,
            'supplier_id' => 'required' ,
            'unit_of_measure' => 'required' ,
        ]);

        $query = product::create($request->all());

        $temporaryFile = TemporaryFile::where('folder' , $request->filepond)->first();

        if($temporaryFile){
            $query->addMedia(storage_path('app/public/images/tmp/'.$request->filepond . '/' . $temporaryFile->filename))
            ->toMediaCollection('images');
            rmdir(storage_path('app/public/images/tmp/'.$request->filepond));
            $temporaryFile->delete();
        }

        return response()->json(['success' => true, 'message' => 'Create successfully']);
    }

    /**
     * delete PRODUCT
     */
    public function deleteProduct($id)
    {
        $product = product::find($id);

        $deleted = $product->delete();

        if($deleted){
            $response['success'] = 1;
        }
        return response()->json($response);

    }

     /**
     * update supplier
     */
    public function getSingleProduct($id)
    {
        $product = product::find($id);
        return response()->json(['success' => true, 'data' => $product]);
    }

    public function updateProduct(Request $request ,$id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required' ,
            'brand_id' => 'required' ,
            'category_id' => 'required' ,
            'unit_price' => 'required' ,
            'current_stock' => 'required' ,
            'supplier_id' => 'required' ,
            'unit_of_measure' => 'required' ,
        ]);

        $product = product::find($id);
        $product->name =$request->name;
        $product->description =$request->description;
        $product->brand_id =$request->brand_id;
        $product->category_id =$request->category_id;
        $product->unit_price =$request->unit_price;
        $product->current_stock =$request->current_stock;
        $product->supplier_id =$request->supplier_id;
        $product->unit_of_measure =$request->unit_of_measure;
        $product->update();

        $temporaryFile = TemporaryFile::where('folder' , $request->filepond1)->first();

        if($temporaryFile){
            $product->clearMediaCollection('images');

            $product->addMedia(storage_path('app/public/images/tmp/'.$request->filepond1 . '/' . $temporaryFile->filename))
            ->toMediaCollection('images');
            rmdir(storage_path('app/public/images/tmp/'.$request->filepond1));
            $temporaryFile->delete();

            // Define the path to the directory
            $directory = storage_path('app/public/images/tmp/'.$product->product_id);

            // Remove the directory and its contents
            if (File::exists($directory)) {
                File::deleteDirectory($directory);
            }
        }

        return response()->json(['success' => true, 'message' => 'Create successfully']);
    }
}
