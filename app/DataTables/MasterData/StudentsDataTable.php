<?php

namespace App\DataTables\MasterData;

use App\Models\Students;
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
            ->editColumn('user.active', function ($row) {
                return $row->user->active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-warning">Non Active</span>';
            })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.students.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn()
            ->rawColumns(['user.active', 'action']);
    }

    public function query(Students $model): QueryBuilder
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
            Column::make('user.active')->title('Status'),
        ]);
    }

    protected function filename(): string
    {
        return 'Students_' . date('YmdHis');
    }
}
