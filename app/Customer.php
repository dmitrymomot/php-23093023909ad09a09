<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'phone_number'];

    /**
     * Get full name of customer
     *
     * @return string
     */
    public function name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get all customers list as associative array
     *
     * @return array
     */
    public function getList()
    {
        return $this
            ->select(['id', DB::raw("printf('%s, %s', `last_name`, `first_name`) as name")])
            ->pluck('name', 'id');
    }

    /**
     * Get all bookings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Determine whether the customer is availbale
     *
     * @param string $date
     * @param string $time
     * @param int $duration
     *
     * @return bool
     */
    public function isAvailable($date, $time, $duration)
    {
        return $this->bookings()->crossing($date, $time, $duration)->get()->count() == 0;
    }

    /**
     * Set cleaned phone number
     *
     * @param string $value
     */
    protected function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = '+'.preg_replace('/\D+/', '', $value);
    }
}
