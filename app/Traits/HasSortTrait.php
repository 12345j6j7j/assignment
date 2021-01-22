<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSortTrait
{

    /**
     * method used to sort model
     *
     * @param Builder $query
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function scopeSort(Builder $query)
    {
        foreach (request()->all() as $key => $attribute) {

            if (!empty(self::$sortable) && in_array($key, self::$sortable)) {
                $query->orderBy($this->table . '.' . $key, request('DESC') ? 'DESC' : 'ASC');
            }

            if (!empty(self::$sortable_translated) && in_array($key, self::$sortable_translated)) {
                $query->select($this->table . '.*')
                    ->join($this->translated_table, $this->table . '.id', '=', $this->translated_table . '.' . $this->translatable_relations[get_class($this)])
                    ->where($this->translated_table . '.locale', app()->getLocale())
                    ->groupBy($this->table . '.id')
                    ->orderBy($key, request('DESC') ? 'DESC' : 'ASC');
            }
        }
        return request('lists') ? $query->get() : $query->paginate(request('paginate') ?: self::$paginate);
    }

    /**
     * method used to sort items
     *
     * @param $items
     * @param int $parent
     * @param int $level
     * @param int $order
     */
    public static function orderItems($items, $parent = 0, $order = 0)
    {
        if (count($items) > 0) {
            foreach ($items as $item) {
                $old = self::find($item['id']);
                if (!empty($old) && ($old->parent != $parent || $old->order != ++$order)) {
                    $old->update(['parent' => $parent, 'order' => $order]);
                }
                if (!empty($item['children'])) {
                    self::orderItems($item['children'], $item['id']);
                }
            }
        }
    }
}
