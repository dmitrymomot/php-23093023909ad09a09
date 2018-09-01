<?php

namespace App\Providers;

use DB;
use Log;
use Validator;

use App\Cleaner;
use App\Customer;

use Carbon\Carbon;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator as ValidatorParam;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_customer_available', function ($attribute, $value, $parameters, ValidatorParam $validator) {
            $data = $validator->getData();
            $customer = Customer::findOrFail($value);
            $count = $customer->bookings()->crossing(array_get($data, 'date'), array_get($data, 'time'), array_get($data, 'duration'))->count();

            return intval($count) == 0;
        });

        Validator::extend('is_cleaner_available', function ($attribute, $value, $parameters, ValidatorParam $validator) {
            $data = $validator->getData();
            $customer = Cleaner::findOrFail($value);
            $count = $customer->bookings()->crossing(array_get($data, 'date'), array_get($data, 'time'), array_get($data, 'duration'))->count();

            return intval($count) == 0;
        });

        Validator::extend('phone_number', function ($attribute, $value) {
            $phoneNumber = preg_replace('/\D+/', '', $value);
            return !(strlen($phoneNumber) < 11 || strlen($phoneNumber) > 15 || !preg_match('/\+.*/', $value));
        });

        Validator::extend('unique_phone_number', function ($attribute, $value, $parameters, ValidatorParam $validator) {
            if (count($parameters) < 2) {
                return false;
            }

            $phoneNumber = '+'.preg_replace('/\D+/', '', $value);
            $q = DB::table($parameters[0])->select('id')->where($parameters[1], $phoneNumber);
            if (array_has($parameters, 2)) {
                $q = $q->where('id', '!=', $parameters[2]);
            }

            return !($q->count() > 0);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        DB::enableQueryLog();
        DB::listen(
            function (QueryExecuted $sql) {
                Log::debug($sql->sql);
            }
        );
    }
}
