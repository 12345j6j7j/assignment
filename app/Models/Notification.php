<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['name','content'];

    /**
     * method used to escape html from in content attribute
     *
     * @param $value
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value);
    }
    
    /**
     * method used to make belongs-to-many connection between Notification and Rank model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ranks()
    {
        return $this->belongsToMany(Rank::class)
            ->withTimestamps();
    }

    /**
     * method used to make belongs-to-many connection between Notification and Rank model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
