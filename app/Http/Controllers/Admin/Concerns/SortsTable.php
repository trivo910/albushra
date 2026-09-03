<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait SortsTable
{
    private function applySort(Builder $query, Request $request, array $allowed, string $default, string $defaultDirection = 'desc'): array
    {
        $sort = $request->get('sort', $default);
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

        if (! in_array($sort, $allowed, true)) {
            $sort = $default;
            $direction = $defaultDirection;
        }

        $query->orderBy($sort, $direction);

        return ['sort' => $sort, 'direction' => $direction];
    }
}
