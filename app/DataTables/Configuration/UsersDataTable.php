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
            ->addColumn('role', function($row){
                return ucfirst($row->roles->pluck('name')->implode(','));
            })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('configuration.users.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->editColumn('gender', function ($row) {
                return $row->gender === 'male' ? '<span class="d-flex align-item-middle gap-2"><i class="fs-5 text-success las la-mars"></i> Male</span>' : '<span class="d-flex align-item-middle gap-2"><i class="fs-5 text-primary las la-venus"></i> Female</span>';
            })
            ->editColumn('active', function ($row) {
                return $row->active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-danger">No Active</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['gender', 'active', 'action']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model
        ->newQuery()
        ->whereHas('roles', fn($qry) => $qry->whereIn('name', ['admin', 'teacher']));
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
            Column::make('gender')->width(100),
            Column::make('role')->searchable(false)->width(100),
            Column::make('active')->title('Status')->width(100),
        ]);
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
