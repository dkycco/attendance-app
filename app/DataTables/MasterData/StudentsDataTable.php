<?php

namespace App\DataTables\MasterData;

use App\Models\Student;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentsDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.students.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->editColumn('user.gender', function ($row) {
                return $row->user->gender === 'male' ? '<span class="d-flex align-item-middle gap-2"><i class="fs-5 text-success las la-mars"></i> Male</span>' : '<span class="d-flex align-item-middle gap-2"><i class="fs-5 text-primary las la-venus"></i> Female</span>';
            })
            ->editColumn('user.active', function ($row) {
                return $row->user->active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-warning">Non Active</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['user.gender', 'user.active', 'action']);
    }

    public function query(Student $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'faculty', 'study_program', 'class_name');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('students-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('user.name')->title('Name'),
            Column::make('nim')->title('NIM'),
            Column::make('faculty.initial')->title('Faculty'),
            Column::make('study_program.initial')->title('Study Program'),
            Column::make('class_name.name')->title('Class Name'),
            Column::make('user.gender')->title('Gender')->width(100),
            Column::make('user.active')->title('Status')->width(100),
        ]);
    }

    protected function filename(): string
    {
        return 'Students_' . date('YmdHis');
    }
}
