<?php

namespace App\Services\Validation;

use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class ValidationService extends Validator
{
    public function __call($method, $parameters)
    {
        $rule = Str::snake(substr($method, 8));

        if (isset($this->extensions[$rule])) {
            return $this->callExtension($rule, $parameters);
        }

        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Get the explicit keys from an attribute flattened with dot notation.
     *
     * @param string $attribute
     * @return array
     */
    protected function getExplicitKeys($attribute): array
    {
        $pattern = str_replace('\*', '([^\.]+)', preg_quote($this->getPrimaryAttribute($attribute), '/'));

        if (preg_match('/^'.$pattern.'/', $attribute, $keys)) {
            array_shift($keys);

            return $keys;
        }

        return [];
    }

    /**
     * Replace each field parameter which has asterisks with the given keys.
     *
     * @param array $parameters
     * @param array $keys
     * @return array
     */
    protected function replaceAsterisksInParameters(array $parameters, array $keys): array
    {
        return array_map(function ($field) use ($keys) {
            return vsprintf(str_replace('*', '%s', $field), $keys);
        }, $parameters);
    }
}
