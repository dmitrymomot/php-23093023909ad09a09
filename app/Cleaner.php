<?php

namespace App;

use DB;
use HTML;
use DateTime;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Cleaner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cleaners';

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
    protected $fillable = ['first_name', 'last_name', 'quality_score'];

    /**
     * Get full name of cleaner
     *
     * @return string
     */
    public function name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get all cleaners list as associative array
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
     * Get all cities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->belongsToMany(City::class, 'cities_cleaners');
    }

    /**
     * Remove related city for all cleaners
     * Using to clean realtions after a city deletion
     *
     * @param int $cityId
     *
     * @return bool
     */
    public function detouchCity($cityId)
    {
        return DB::table('cities_cleaners')->where('city_id', $cityId)->delete();
    }

    /**
     * Clean city relations for a cleaner
     * Using after deleting of the cleaner
     *
     * @param int $cleanerId
     *
     * @return bool
     */
    public function removeCityRelationsFor($cleanerId)
    {
        return DB::table('cities_cleaners')->where('cleaner_id', $cleanerId)->delete();
    }

    /**
     * Get available cleaner
     *
     * @param string $date
     * @param string $time
     * @param string $duration
     * @param int $cityId
     *
     * @return self
     */
    public function getAvailable($date, $time, $duration, $cityId)
    {
        return $this->whereDoesntHave('bookings', function($q) use($date, $time, $duration) {
            $q->crossing($date, $time, $duration);
        })->whereHas('cities', function($q) use($cityId) {
            $q->whereId($cityId);
        })->first();
    }

    /**
     * Get cities list as a string
     *
     * @return string
     */
    public function getCitiesAsString()
    {
        return implode(', ', array_map(function($city) {
             return link_to_route('city.show', $city['city'].', '.$city['state'], ['id' => $city['id']]);
        }, $this->cities->toArray()));
    }
}
