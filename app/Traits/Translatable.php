<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait Translatable
{
    /**
     * This "Accessor" magic method runs whenever you call $model->column_name.
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        // Check if the column is defined as translatable in the model
        if (isset($this->translatable) && in_array($key, $this->translatable)) {

            // If the value is already an array/object (JSON)
            $translations = is_string($value) ? json_decode($value, true) : $value;

            if (is_array($translations)) {
                $locale = App::getLocale();

                // Return the current locale, or fallback to the first available, or the raw value
                return $translations[$locale] ?? $translations[config('app.fallback_locale')] ?? $value;
            }
        }

        return $value;
    }
}
