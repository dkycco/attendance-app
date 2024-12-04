<?php

namespace App\DataTables\Configuration;

use App\Models\User;
use App\Traits\DataTable as TraitsDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    use TraitsDataTable;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('active', function ($row) {
                return $row->active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-warning">Non Active</span>';
            })
            ->addColumn('role', function($row){
                return $row->roles->pluck('name')->implode(',');
            })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('configuration.users.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn()
            ->rawColumns(['active', 'action']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('user-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('name'),
            Column::make('email'),
            Column::make('role')->searchable(false)->orderable(false),
            Column::make('active')->title('Status'),
        ]);
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
