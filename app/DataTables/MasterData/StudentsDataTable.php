<?php

namespace App\DataTables\MasterData;

use App\Models\Mahasiswa;
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
            // ->editColumn('active', function ($row) {
            //     return $row->active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-warning">Non Active</span>';
            // })
            ->addColumn('action', function ($row) {
                $actions = [];

                $actions['Edit'] = route('master-data.students.edit', $row->id);

                return $this->registerAction($row, $actions);
            })
            ->addIndexColumn();
    }

    public function query(Mahasiswa $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'fakultas', 'prodi');
    }

    public function html(): HtmlBuilder
    {
        return $this->getBuilder('student-table');
    }

    public function getColumns(): array
    {
        return $this->ColumnWithAction([
            Column::make('user.name')->title('Nama'),
            Column::make('nim')->title('NIM'),
            Column::make('tmp_lahir')->title('Tempat Lahir'),
            Column::make('tgl_lahir')->title('Tanggal Lahir'),
            Column::make('fakultas.singkat')->title('Fakultas'),
            Column::make('prodi.singkat')->title('Prodi'),
            Column::make('kelas.nama')->title('Kelas'),
        ]);
    }

    protected function filename(): string
    {
        return 'Students_' . date('YmdHis');
    }
}
