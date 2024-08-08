<?php

namespace App\DataTables;

use App\Models\supply;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SupplierDataTable extends DataTable
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
            $deleteButton = "<button class='btn btn-sm btn-danger deleteSupplier' data-id='".$row->supplier_id."'><i class='bi bi-trash'></i></button>";

             // Update Button
            $updateButton = "<button  data-modal-toggle='updateModal' data-modal-target='updateModal' class='btn btn-sm btn-info updateUser' data-id='".$row->supplier_id."'><i class='bi bi-pencil-square'></i></button>";

            return $updateButton.''.$deleteButton;
       })->rawColumns(['action'])
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(supply $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('supplier-table')
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
            Column::make('supplier_id'),
            Column::make('name'),
            Column::make('contact_name'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Supplier_' . date('YmdHis');
    }
}
