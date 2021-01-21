<?php

namespace App\Traits;

trait HasTranslationTrait
{
    /**
     * method used to set Accessor for translatable properties
     *
     * @param $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);

        if (in_array($key, $this->translatable)) {
            $value = $this->getTranslationsByField($key);
        }

        return $value;
    }

    /**
     * method used to set Mutators for translatable properties
     *
     * @param $key
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->translatable)) {
            $value = gettype($value) == 'string' ? json_decode($value, true) : $value;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * method used to get all translations key/values (for missing keys value will be set to null)
     */
    public function getTranslationsByField($field)
    {
        if (!empty(request('cms'))) {
            if (class_exists('App\Language') && method_exists('App\Language', 'getLocales')) {
                foreach (app('App\Language')->getLocales() as $locale) {
                    if (!isset(json_decode($this->attributes[$field])->$locale)) {
                        $array = json_decode($this->attributes[$field], true);
                        $array[$locale] = null;
                        $this->attributes[$field] = json_encode($array);
                    }
                }
            }
        } else {
            if(!empty($this->attributes[$field])){
                return !empty(json_decode($this->attributes[$field])->{app()->getLocale()}) ? json_decode($this->attributes[$field])->{app()->getLocale()} : json_decode($this->attributes[$field])->{env('APP_LOCALE')};
            }
        }

        return json_decode($this->attributes[$field]);
    }
}
