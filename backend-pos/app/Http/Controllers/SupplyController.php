<?php

namespace App\Http\Controllers;

use App\Models\supply;
use Illuminate\Http\Request;
use App\DataTables\SupplierDataTable;

class SupplyController extends Controller
{
    //
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('pos.supplier');
    }

    /**
     * supplier create
     */
    public function createSupplier(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'contact_name' => 'required' ,
            'phone' => 'required' ,
            'email' => 'required'
        ]);
        $query =supply::create($request->all());
        return response()->json(['success' => true, 'message' => 'Create successfully']);
    }

    /**
     * delete supplier
     */
    public function deleteSupplier($id)
    {
        $deleted = supply::where('supplier_id' ,$id)->delete();
        if($deleted){
            $response['success'] = 1;
        }
        return response()->json($response);
    }

    /**
     * update supplier
     */
    public function getSingleSupplier($id)
    {
        $supplier = supply::where('supplier_id', $id)->get();
        return response()->json(['success' => true, 'data' => $supplier]);
    }

    public function updateSupplier(Request $request ,$id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'contact_name' => 'required' ,
            'phone' => 'required' ,
            'email' => 'required'
        ]);
        supply::where('supplier_id', $id)->update($request->all());

        return response()->json(['success' => true, 'message' => 'Updated successfully']);
    }
}
