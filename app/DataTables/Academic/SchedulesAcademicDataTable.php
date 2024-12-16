<?php

namespace App\DataTables\Academic;

use App\Models\Schedule;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SchedulesAcademicDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['View Student'] = route('academic.schedules.view_student', $row->id);
                $actions['Present'] = route('academic.schedules.present', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn()
            ->rawColumns(['action']);
    }

    public function query(Schedule $model): QueryBuilder
    {
        return $model->newQuery()
            ->whereHas('course', fn($qry) => $qry->where('teacher_id', getUser('id')))
            ->with('course', 'course.teacher', 'room');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('schedules-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('course.name')->title('Course'),
            Column::make('room.name')->title('Room'),
            Column::make('semester_id')->title('Semester'),
            Column::make('day'),
            Column::make('entry_time')->title('Entry Time'),
            Column::make('exit_time')->title('Exit Time'),
        ]);
    }

    protected function filename(): string
    {
        return 'Schedules_' . date('YmdHis');
    }
}
