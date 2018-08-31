<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Booking
 *
 */
	class Booking extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \App\Cleaner $cleaner
 * @property-read \App\Customer $customer
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 */
	class Customer extends \Eloquent {}
}

namespace App{
/**
 * App\Cleaner
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 */
	class Cleaner extends \Eloquent {}
}

