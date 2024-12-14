<?php

namespace App\DataTables\MasterData;

use App\Models\ClassName;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class ClassNameDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.class-name.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(ClassName $model): QueryBuilder
    {
        return $model->newQuery()->with('faculty', 'study_program', 'semester');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('class-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('name'),
            Column::make('faculty.name')->title('Faculty'),
            Column::make('study_program.name')->title('Study Program'),
            Column::make('semester.name'),
        ]);
    }

    protected function filename(): string
    {
        return 'ClassName_' . date('YmdHis');
    }
}
