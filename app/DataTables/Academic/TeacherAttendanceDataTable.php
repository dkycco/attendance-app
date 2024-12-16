<?php

namespace App\DataTables\Academic;

use App\Models\TeacherAttendance;
use App\Traits\DataTable as TraitsDataTable;
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
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['View Student'] = route('academic.attendance.view_student', $row->schedule_id);
                // $actions['Present'] = route('academic.schedules.present', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn()
            ->rawColumns(['action']);
    }

    public function query(TeacherAttendance $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('attendance-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
           Column::make('schedule_id'),
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
