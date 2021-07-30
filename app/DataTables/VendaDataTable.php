<?php

namespace App\DataTables;

use App\Models\Venda;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($venda){
                $rotaExcluir =route('vendas.destroy', $venda);
                $acoes = link_to_route('vendas.edit', 'Editar', $venda, ['class'=> 'btn btn-primary btn-sm']);
                $acoes .=FormFacade::button('Excluir', ['class' => 'btn btn-danger btn-sm m1-1', 'onclick' => "excluir('$rotaExcluir')"]);
                return $acoes;
            });
    }

    public function query(Venda $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('venda-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Nova Venda'),
                        Button::make('export')->text('Exportar')
                       
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('Ação'),
            Column::make('id'),
            Column::make('cliente_id'),
            Column::make('forma_pagamento'),
            Column::make('total'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Venda_' . date('YmdHis');
    }
}
