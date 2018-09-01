<?php

namespace App;

use DB;
use DateTime;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

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
    protected $fillable = ['date', 'time', 'duration', 'customer_id', 'cleaner_id', 'city_id'];

    /**
     * Get city model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get cleaner model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class);
    }

    /**
     * Get customer model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get date and time of booking
     *
     * @return string
     */
    public function dateTime()
    {
        return Carbon::parse($this->date.' '.$this->time)->format('d M, Y h:i a');
    }

    /**
     * Get date and time of booking
     *
     * @return string
     */
    public function dateStart()
    {
        return Carbon::parse($this->date.' '.$this->time)->format('d M, Y h:i a');
    }

    /**
     * Get date and time of booking
     *
     * @return string
     */
    public function dateEnd()
    {
        return Carbon::parse($this->date.' '.$this->time)->addHours($this->duration)->format('d M, Y h:i a');
    }

    /**
     * Get cleanin duration in human readable format
     *
     * @return string
     */
    public function cleaningDuration()
    {
        return $this->duration.' '.str_plural('hour', $this->duration);
    }

    /**
     * Scope a query to get bookings in needed period.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $date
     * @param string $time
     * @param int $duration
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCrossing($query, $date, $time, $duration)
    {
        $timeEnd = Carbon::parse($time)->addHours($duration)->format('H:i');

        return $query->where(function($q) use($date, $time, $timeEnd) {
            $q->select(DB::raw(1))->from('bookings')->orWhere(function($q) use($date, $time, $timeEnd) {
                $q->where('date', '=', $date)->where('time', '>=', $time)->where('time', '<=', $timeEnd);
            })->orWhere(function($q) use($date, $time) {
                $q->where('date', '=', $date)->where('time', '<', $time)->where(DB::raw("TIME(`time`, printf('+%d hours', `duration`))"), '>', $time);
            })->orWhere(function($q) use($date, $timeEnd) {
                $q->where('date', '=', $date)->where('time', '<', $timeEnd)->where(DB::raw("TIME(`time`, printf('+%d hours', `duration`))"), '>', $timeEnd);
            });
        });
    }

    /**
     * Add new booking
     *
     * @param int $customerId
     * @param int $cleanerId
     * @param array $attr
     *
     * @return self
     */
    public function addNew($customerId, $cleanerId, array $attr)
    {
        return parent::create(array_add(array_add($attr, 'customer_id', $customerId), 'cleaner_id', $cleanerId));
    }
}
