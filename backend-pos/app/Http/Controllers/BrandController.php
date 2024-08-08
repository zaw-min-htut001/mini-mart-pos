<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;
use App\DataTables\BrandsDataTable;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    //
    public function index(BrandsDataTable $dataTable)
    {
        return $dataTable->render('pos.brand');
    }

    public function createBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $query =brand::create($request->all());
        return response()->json(['success' => true, 'message' => 'Create successfully']);
    }

    public function deleteBrand($brand_id)
    {
        $brandDeleted = brand::where('brand_id' ,$brand_id)->delete();

        if($brandDeleted){
            $response['success'] = 1;
        }
        return response()->json($response);
    }

}
