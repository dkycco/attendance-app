<?php

namespace App\DataTables\MasterData;

use App\Models\Courses;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.courses.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(Courses $model): QueryBuilder
    {
        return $model->newQuery()->with('faculty', 'study_program');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('courses-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('name'),
            Column::make('initial'),
            Column::make('faculty.name')->title('Faculty'),
            Column::make('study_program.name')->title('Study Program'),
        ]);
    }

    protected function filename(): string
    {
        return 'Courses_' . date('YmdHis');
    }
}
