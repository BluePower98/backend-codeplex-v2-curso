<?php

namespace App\Providers;

use App\Services\Validation\ValidationService;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    protected bool $defer = false;

    public function boot(){
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages)
        {
            return new ValidationService($translator, $data, $rules, $messages);
        });

        $this->app['validator']->extend('only_numbers', function($attribute, $value)
        {
            return preg_match('/^\d+$/u', $value);
        }, 'The :attribute field be must contain only numbers.');
    }

    public function register(){

    }
}
