<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSortables
{
    public function scopeWithSortables($query)
    {
        if (!request()->filled('sort_by')) {
            return $query->orderBy('id', 'desc');
        }

        list($sort, $order) = Str::of(request()->get('sort_by'))->explode('|');

        if (!$this->canSort($sort)) {
            return $query->orderBy('id', 'desc');
        }

        return $query->orderBy($sort, $order);
    }

    public function scopeGetPaginate($query)
    {
        return $query->withSortables()->paginate(request()->get('per_page', 15));
    }

    private function canSort(string $value)
    {
        return in_array($value, $this->sortables);
    }

    public function scopeAddSortable($query, string $sortable)
    {
        $this->sortables = array_merge($this->sortables, [$sortable]);

        return $query;
    }
}
