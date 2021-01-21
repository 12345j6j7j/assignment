<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlugTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->setAllSlugs();
        });
    }

    /**
     * method used to set all slug translations key/values (for missing keys value will be set to null)
     */
    public function setAllSlugs()
    {
        if (property_exists($this, 'sluggable')) {
            foreach ($this->sluggable as $key => $value) {
                if(!empty(request($value['field']))){
                    if ($value['json']) {
                        $array = [];
                        $fields = $this->prepareFields(request($value['field']));
                        foreach ($fields as $itemKey => $item) {
                            $array[$itemKey] = Str::slug($item);
                        }

                        $this->{$key} = $array;
                    } else {
                        $this->{$key} = Str::slug($this->{$value->name});
                    }
                }
            }
        }
    }

    /**
     * Method used to prepare translatable fields
     *
     * @param $fields
     * @return mixed
     */
    private function prepareFields($fields){
        return gettype($fields) == 'string' ? json_decode($fields, true) : $fields;
    }
}
