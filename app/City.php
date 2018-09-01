<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

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
    protected $fillable = ['city', 'state'];

    /**
     * Get cities list
     *
     * @return array
     */
    public function getList()
    {
        $all = $this->orderBy('state', 'ASC')->orderBy('city', 'ASC')->get();
        $arr = [];
        foreach ($all as $item) {
            if (array_key_exists($item->state, $arr)) {
                $arr[$item->state][(string) $item->id] = $item->city;
            } else {
                $arr[$item->state] = [(string) $item->id => $item->city];
            }
        }

        return $arr;
    }
}
