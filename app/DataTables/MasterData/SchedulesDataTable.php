<?php

namespace App\DataTables\MasterData;

use App\Models\Schedules;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SchedulesDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.schedules.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(Schedules $model): QueryBuilder
    {
        return $model->newQuery()->with('course', 'teacher', 'student', 'room');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('schedules-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('course.name')->title('Course'),
            Column::make('teacher.name')->title('Teacher'),
            Column::make('student.nim')->title('Student'),
            Column::make('room.name')->title('Room'),
        ]);
    }

    protected function filename(): string
    {
        return 'Schedules_' . date('YmdHis');
    }
}
