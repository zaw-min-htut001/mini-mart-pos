<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{
    //
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('pos.category');
    }

    /**
     * create category
    */
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $query =category::create($request->all());
        return response()->json(['success' => true, 'message' => 'Create successfully']);
    }

    /**
     * delete category
     */
    public function deleteCategory($id)
    {
        $deleted = category::where('category_id' ,$id)->delete();
        if($deleted){
            $response['success'] = 1;
        }
        return response()->json($response);
    }
}
