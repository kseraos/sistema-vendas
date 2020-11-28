<?php

namespace App\DataTables;

use App\Models\Produto;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProdutoDataTable extends DataTable
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
            ->addColumn('action', function($produto){
                $rotaExcluir =route('produtos.destroy', $produto);
                $acoes = link_to_route('produtos.edit', 'Editar', $produto, ['class'=> 'btn btn-primary btn-sm']);
                $acoes .=FormFacade::button('Excluir', ['class' => 'btn btn-danger btn-sm m1-1', 'onclick' => "excluir('$rotaExcluir')"]);
                return $acoes;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Produto $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Produto $produto)
    {
        return $produto->join('fabricantes', 'fabricantes.id','produtos.fabricante_id' )
                ->select(
                    'produtos.id',
                    'produtos.descricao',
                    'produtos.estoque',
                    'produtos.preco',
                    'fabricantes.nome as fabricante'
                );
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('produto-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Cadastrar Novo'),
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
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('descricao'),
            Column::make('estoque'),
            Column::make('preco'),
            Column::make('fabricante')->name('fabricantes.nome')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Produto_' . date('YmdHis');
    }
}
