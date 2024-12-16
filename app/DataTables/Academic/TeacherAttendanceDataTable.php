<?php

namespace App\DataTables\Academic;

use App\Models\TeacherAttendance;
use App\Traits\DataTable as TraitsDataTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeacherAttendanceDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('entry_time', function($row) {
                return Carbon::parse($row->entry_time)->format('h:i A');
            })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['View Student'] = route('academic.attendance.view_student', $row->schedule_id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn()
            ->rawColumns(['entry_time', 'action']);
    }

    public function query(TeacherAttendance $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('schedule.course');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('attendance-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
           Column::make('schedule.course.name'),
           Column::make('date'),
           Column::make('status'),
           Column::make('entry_time'),
           Column::make('exit_time'),
        ]);
    }

    protected function filename(): string
    {
        return 'TeacherAttendance' . date('YmdHis');
    }
}
