<?php
// app/Traits/HasLocalizable.php

namespace App\Traits;

trait HasLocalizable
{
    /**
     * Get localized attribute.
     * Usage: $model->localize('title') => reads title_id or title_en
     */
    public function localize(string $field): string
    {
        return \App\Helpers\LocalizeHelper::field($this, $field);
    }

    /**
     * Accessor: $model->title_localized
     */
    public function getAttribute($key)
    {
        if (is_string($key) && str_ends_with($key, '_localized')) {
            $field = preg_replace('/_localized$/', '', $key);
            return $this->localize($field);
        }

        return parent::getAttribute($key);
    }

    /**
     * Check if model has an English translation for a field.
     */
    public function hasTranslation(string $field): bool
    {
        $value = $this->{"{$field}_en"} ?? null;
        return $value !== null && $value !== '';
    }
}
