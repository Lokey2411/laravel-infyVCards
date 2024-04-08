<?php

namespace App\Http\Livewire;

use App\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class TemplateTable extends LivewireTableComponent
{
    protected $model = Template::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('Template-table');
        $this->setDefaultSort('id', 'asc');
        $this->setColumnSelectStatus(false);
        $this->setPerPage(10);

        $this->setThAttributes(function(Column $column) {
            if ($column->isField('used_count')) {
              return [
                'class' => 'd-flex justify-content-center',
              ];
            }

            return [];
          });
    }
    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
            ->view('vcards.templates.columns.name')
            ->sortable()->searchable(),
            Column::make(__('messages.vcards_template.used_count'),'id')
            ->view('vcards.templates.columns.count'),
        ];
    }

    public function builder(): Builder
    {
        return Template::with(['vcards', 'media'])->select('templates.*');
    }
}
