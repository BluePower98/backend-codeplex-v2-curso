<?php

namespace App\Helpers\Datatables;

use Yajra\DataTables\EloquentDataTable as YajraEloquentDataTable;

class EloquentDataTable extends YajraEloquentDataTable
{
    /**
     * @param bool $transform
     * @return array
     */
    public function response(bool $transform = false): array
    {
        $this->prepareQuery();

        $results = $this->results();

        $processed = $this->processingResults($results, $transform);

        return $this->renderData($processed);
    }

    /**
     * @param $results
     * @param bool $transform
     * @return array
     */
    private function processingResults($results, bool $transform = false): array
    {
        $processor = new DataProcessor(
            $results,
            $this->getColumnsDefinition(),
            $this->templates,
            $this->request->input('start')
        );

        return $processor->processing($transform);
    }

    /**
     * Render data response.
     *
     * @param array $data
     * @return array
     */
    private function renderData(array $data): array
    {
        $output = $this->attachAppends([
            'draw' => (int) $this->request->input('draw'),
            'recordsTotal' => $this->totalRecords,
            'recordsFiltered' => $this->filteredRecords,
            'data' => $data,
        ]);

        if ($this->config->isDebugging()) {
            $output = $this->showDebugger($output);
        }

        foreach ($this->searchPanes as $column => $searchPane) {
            $output['searchPanes']['options'][$column] = $searchPane['options'];
        }

        return $output;
    }
}
