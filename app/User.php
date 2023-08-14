<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Wildside\Userstamps\Userstamps;
use App\Role;
use App\Account;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable
{
    use Userstamps, Notifiable;

    protected $primaryKey = 'pk_users';
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['pk_users'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function locations()
    {
        return $this->hasMany(UserLocation::class, 'pk_users', 'pk_users');
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'pk_customers', 'pk_customers');
    }

}
