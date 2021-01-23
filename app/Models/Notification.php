<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['name','content'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->content = strip_tags($model->content);
        });
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
     * method used to make belongs-to-many connection between Notification and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
