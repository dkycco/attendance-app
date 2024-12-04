<?php

namespace App\Traits;

use Yajra\DataTables\Html\Column;

trait DataTable
{
    public function getBuilder($table_id)
    {
        return $this->builder()
            ->setTableId($table_id)
            ->parameters(['searchDelay' => 0, 'responsive' => ['details' => ['display' => '$.fn.dataTable.Responsive.display.childRowImmediate']]])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function registerAction($row, array $list_action)
    {
        if (count($list_action)) {
            $dropdown = "<div class='btn-group btn-group-sm'>
            <button type='button' class='btn btn-primary dropdown-toggle waves-effect' data-bs-toggle='dropdown' aria-expanded='false'>
                Choose action
            </button>
            <div class='dropdown-menu' aria-labelledby='btnGroupDrop$row->id'>";

            foreach ($list_action as $title => $url) {
                $dropdown .= "<a class='dropdown-item action' href='$url'>$title</a>";
            }

            return $dropdown . "</div></div>";
        }
    }

    public function ColumnWithAction(array $columns, $first_column = null)
    {
        return array_merge(
            [
                Column::make('DT_RowIndex')->width(20)->title('No')->orderable(false)->searchable(false),
                Column::make('id')->hidden()->searchable(false)
            ],
            $columns,
            [
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ]
        );
    }
}
