<?php
// app/Helpers/LocalizeHelper.php

namespace App\Helpers;

class LocalizeHelper
{
    /**
     * Get localized field value. Falls back to *_id if *_en is empty.
     */
    public static function field(object $model, string $field): string
    {
        $locale = app()->getLocale(); // 'id' or 'en'
        $localizedKey = "{$field}_{$locale}";
        $fallbackKey = "{$field}_id";

        $value = $model->$localizedKey ?? null;

        if ($value === null || $value === '') {
            $value = $model->$fallbackKey ?? '';
        }

        return (string) $value;
    }

    /**
     * Get localized field with explicit locale.
     */
    public static function fieldLocale(object $model, string $field, string $locale): string
    {
        $localizedKey = "{$field}_{$locale}";
        $fallbackKey = "{$field}_id";

        $value = $model->$localizedKey ?? null;

        if ($value === null || $value === '') {
            $value = $model->$fallbackKey ?? '';
        }

        return (string) $value;
    }
}
