<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchableRecords
{
    /**
     * Apply search filters to query
     *
     * @param Builder $query
     * @param string $searchTerm
     * @param array $searchableFields
     * @return Builder
     */
    protected function applySearch(Builder $query, $searchTerm, array $searchableFields)
    {
        if (empty($searchTerm)) {
            return $query;
        }

        return $query->where(function ($q) use ($searchTerm, $searchableFields) {
            foreach ($searchableFields as $field) {
                $q->orWhere($field, 'like', "%{$searchTerm}%");
            }
        });
    }

    /**
     * Get paginated search results
     *
     * @param Builder $query
     * @param string|null $searchTerm
     * @param array $searchableFields
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function searchAndPaginate(Builder $query, $searchTerm, array $searchableFields, $perPage = 10)
    {
        if ($searchTerm) {
            $query = $this->applySearch($query, $searchTerm, $searchableFields);
        }

        return $query->paginate($perPage)->appends(request()->all());
    }
}
