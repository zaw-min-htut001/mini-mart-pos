<?php

namespace App\DataTables;

use App\Models\product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row){
            // Delete Button
            $deleteButton = "<button class='btn btn-sm btn-danger deleteProduct' data-id='".$row->product_id."'><i class='bi bi-trash'></i></button>";
             // Update Button
            $updateButton = "<button data-modal-toggle='productModal' data-modal-target='productModal' class='btn btn-sm btn-info updateProduct' data-id='".$row->product_id."'><i class='bi bi-pencil-square'></i></button>";

            return $updateButton.''.$deleteButton;
        })->rawColumns(['action' , 'image'])
        ->editColumn('category.name', function ($product) {
            return $product->category->name ?? 'N/A'; // Handle cases where the product might not have a category
        })
        ->editColumn('supplier.name', function ($product) {
            return $product->supplier->name ?? 'N/A'; // Handle cases where the product might not have a category
        })
        ->editColumn('brand.name', function ($product) {
            return $product->brand->name ?? 'N/A'; // Handle cases where the product might not have a category
        })
        ->editColumn('image', function ($product) {
            $media = $product->getFirstMediaUrl('images');
            return $media ? "<img src=\"{$media}\" height=\"50\"/>" : 'N/A';
        })
        ->filterColumn('category_id', function ($query, $keyword) {
            $query->whereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            });
        })
        ->filterColumn('supplier_id', function ($query, $keyword) {
            $query->whereHas('supplier', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            });
        })
        ->filterColumn('brand_id', function ($query, $keyword) {
            $query->whereHas('brand', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            });
        })
        ->setRowId('product_id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(product $model): QueryBuilder
    {
        return $model->newQuery()->with(['category', 'brand', 'supplier', 'media'])
            ->select('products.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('name'),
            Column::make('image')->title('image')->data('image')->orderable(false)->searchable(false),
            Column::make('brand_id')->title('Brand')->data('brand.name'),
            Column::make('category_id')->title('Category')->data('category.name'),
            Column::make('unit_price'),
            Column::make('current_stock'),
            Column::make('supplier_id')->title('Supplier')->data('supplier.name'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
