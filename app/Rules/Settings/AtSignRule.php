<?php

namespace App\Rules\Settings;

use Illuminate\Contracts\Validation\Rule;

class AtSignRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!str_contains($value, '@')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("Ovo polje ne smije da sadrži '@' karakter.");
    }
}
