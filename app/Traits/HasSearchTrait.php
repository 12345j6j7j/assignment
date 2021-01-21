<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use DB;
use Session;

trait HasSearchTrait
{

    /**
     * method used for search model
     *
     * @return mixed
     */
    public function scopeSearch(Builder $query)
    {
        foreach (request()->all() as $key => $attribute) {
            if (in_array($key, self::$searchable)) {
                $key = $this->camelCase($key);
                $query->$key($attribute);
            }
        }
        return $query;
    }

    /**
     * method used to search members by ID
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchId(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.id', $value);
        }
    }

    /**
     * method used to search messages by is_visible
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchIsVisible(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.is_visible', $value);
        }
    }

    /**
     * method used to search by category_id
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchCategoryId(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.category_id', $value);
        }
    }

    /**
     * method used to search books
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchBooks(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.title', 'like', '%'.$value.'%')
                ->orWhere($this->table . '.id', $value);
        }
    }

    /**
     * method used to search posts by category_news_id
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchCategoryNewsId(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.category_news_id', $value);
        }
    }

    /**
     * method used to search by menu_id
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchMenuId(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.menu_id', $value);
        }
    }

    /**
     * method used to search by group_id
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchGroupId(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.group_id', $value);
        }
    }

    /**
     * method used to search messages by parent
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchParent(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.parent', $value);
        }
    }

    /**
     * method used to search address by name, email, city
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchAddress(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.email', 'like', '%' . $value . '%')
                ->orWhere($this->table . '.name', 'like', '%' . $value . '%')
                ->orWhere($this->table . '.city', 'like', '%' . $value . '%');
        }
    }

    /**
     * method used to search cart by name, email, street, city
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchCart(Builder $query, $value)
    {
        $joinTable = 'addresses';
        $query
            ->select('*', $joinTable . '.name', $joinTable . '.email', $joinTable . '.street', $joinTable . '.phone')
            ->join($joinTable, $this->table . '.address_id', '=', $joinTable . '.id');

        if ($value != '') {
            $query
                ->where($joinTable . '.email', 'like', '%' . $value . '%')
                ->orWhere($joinTable . '.name', 'like', '%' . $value . '%')
                ->orWhere($joinTable . '.street', 'like', '%' . $value . '%')
                ->orWhere($joinTable . '.city', 'like', '%' . $value . '%');
        }

        return $query;
    }

    /**
     * method used to search by name and zipcode
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchCity(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.name', 'like', '%' . $value . '%')
                ->orWhere($this->table . '.zipcode', 'like', '%' . $value . '%');
        }
    }

    /**
     * method used to search by name
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchName(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.name', 'like', '%' . $value . '%');
        }
    }

    /**
     * method used to search by title
     *
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeSearchTitle(Builder $query, $value)
    {
        if ($value != '') {
            return $query->where($this->table . '.title', 'like', '%' . $value . '%');
        }
    }

    /**
     * method used to parse underscores string to camelCase
     *
     * @param string $str
     * @return string
     */
    private function camelCase($str)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
    }
}
