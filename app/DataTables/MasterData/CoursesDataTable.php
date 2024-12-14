<?php

namespace App\DataTables\MasterData;

use App\Models\Course;
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

    public function query(Course $model): QueryBuilder
    {
        return $model->newQuery()->with('faculty', 'study_program', 'teacher');
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
            Column::make('faculty.initial')->title('Faculty'),
            Column::make('study_program.initial')->title('Study Program'),
            Column::make('teacher.name')->title('Teacher')
        ]);
    }

    protected function filename(): string
    {
        return 'Courses_' . date('YmdHis');
    }
}
