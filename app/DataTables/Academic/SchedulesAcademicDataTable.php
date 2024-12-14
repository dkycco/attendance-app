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
            ->addColumn('status', function ($row) {
                if($row->status == 1) {
                    return '<span class="badge text-bg-warning">Absent with reason</span>';
                }

                if($row->status == 2) {
                    return '<span class="badge text-bg-danger">Absent</span>';
                }

                if($row->actual_entry_time && !$row->actual_exit_time) {
                    return '<span class="badge text-bg-primary">In progress</span>';
                }

                if($row->actual_entry_time && $row->actual_exit_time) {
                    return '<span class="badge text-bg-success">Success</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $actions = [
                    'Present' => route('academic.schedules.update', $row->id),
                    'Absent' => route('academic.schedules.update', $row->id)
                ];

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'action']);
    }

    public function query(Schedule $model): QueryBuilder
    {
        return $model->newQuery()
        ->where('teacher_id', getUser('id'))
        ->with('course', 'teacher', 'room');
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
            Column::make('date'),
            Column::make('entry_time')->title('Entry Time'),
            Column::make('exit_time')->title('Exit Time'),
            Column::make('status')
        ]);
    }

    protected function filename(): string
    {
        return 'Schedules_' . date('YmdHis');
    }
}
