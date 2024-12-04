<?php

namespace App\DataTables\MasterData;

use App\Models\Prodi;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudyProgramDataTable extends DataTable
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

                $actions['Edit'] = route('master-data.study-program.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(Prodi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('study-program-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('nama'),
            Column::make('singkat'),
        ]);
    }

    protected function filename(): string
    {
        return 'StudyProgram_' . date('YmdHis');
    }
}
