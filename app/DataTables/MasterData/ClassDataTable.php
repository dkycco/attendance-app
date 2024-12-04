<?php

namespace App\DataTables\MasterData;

use App\Models\Kelas;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class ClassDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            // ->editColumn('active', function ($row) {
            //     return $row->active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-warning">Non Active</span>';
            // })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.class.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(Kelas $model): QueryBuilder
    {
        return $model->newQuery()->with('fakultas', 'prodi');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('faculty-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('nama'),
            Column::make('fakultas.nama')->title('Fakultas'),
            Column::make('prodi.nama')->title('Prodi'),
            Column::make('tingkat'),
        ]);
    }

    protected function filename(): string
    {
        return 'Class_' . date('YmdHis');
    }
}
