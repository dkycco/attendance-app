<?php

namespace App\DataTables\MasterData;

use App\Models\Schedule;
use App\Traits\DataTable as TraitsDataTable;
use Carbon\Carbon;
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
            ->addColumn('teacher_name', function($row) {
                return $row->course && $row->course->teacher ? $row->course->teacher->name : '-';
            })
            ->addColumn('room', function ($row) {
                return $row->room->name. ' | ' .$row->room->room_location;
            })
            ->addColumn('entry_exit_time', function($row) {
                return Carbon::parse($row->entry_time)->format('h:i A'). ' - ' .Carbon::parse($row->exit_time)->format('h:i A');
            })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.schedules.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(Schedule $model): QueryBuilder
    {
        return $model->newQuery()->with('course', 'course.teacher');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('weekly-schedules-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('course.name')->title('Course'),
            Column::make('teacher_name')->title('Teacher'),
            Column::make('room'),
            Column::make('day'),
            Column::make('entry_exit_time')->title('Entry & Exit Time'),
        ]);
    }

    protected function filename(): string
    {
        return 'WeeklySchedules_' . date('YmdHis');
    }
}
