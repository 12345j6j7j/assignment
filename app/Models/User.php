<?php

namespace App\Models;

use App\Traits\HasPermissionTrait;
use App\Traits\HasRoleTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissionTrait, HasRoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ship_id', 'rank_id', 'name', 'surname', 'email', 'password', 'is_active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * set user's hash password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    
    /**
     * set user's is_active attribute
     *
     * @param $value
     */
    public function setIsActiveAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['is_active'] = 0;
        }
    }
    
    /**
     * capitalize user's first_name attribute
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['name'] = ucfirst(strtolower($value));
        }
    }

    /**
     * capitalize user's last_name attribute
     *
     * @param $value
     */
    public function setSurnameAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['surname'] = ucfirst(strtolower($value));
        }
    }

    /**
     * method used to make belongs-to-many connection between User and Role model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * method used to make belongs-to-many connection between User and Ship model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    /**
     * method used to make belongs-to-many connection between User and Rank model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    /**
     * method used to make belongs-to-many connection between Notification and Rank model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications()
    {
        return $this->belongsToMany(Notification::class)
            ->withTimestamps();
    }
}
