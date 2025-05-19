<?php

namespace App\Http\Filters\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseFilter
{
    protected $query;
    protected $request;

    public function __construct(Builder $query, Request $request)
    {
        $this->query = $query;
        $this->request = $request;
    }

    abstract public function apply();

    protected function whereLike($column, $value)
    {
        if (!empty($value)) {
            $this->query->where($column, 'LIKE', "%{$value}%");
        }
    }

    protected function whereEqual($column, $value)
    {
        if (!is_null($value)) {
            $this->query->where($column, $value);
        }
    }

    protected function whereDate($column, $operator, $value)
    {
        if (!empty($value)) {
            $this->query->whereDate($column, $operator, $value);
        }
    }

    public function whereBetween($column, $start, $end)
    {
        if ($start && $end) {
            $this->query->whereBetween($column, [$start, $end]);
        }
    }

    protected function sort()
    {
        $this->query->orderBy(
            $this->request->get('sort_by', 'id'),
            $this->request->get('sort_direction', 'desc')
        );
    }
}
