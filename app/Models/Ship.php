<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUploudTrait;

class Ship extends Model
{
    use HasFactory, HasUploudTrait;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'serial_number', 'image'];

    /**
     * The attribute that are used for image width
     *
     * @var int
     */
    protected $imageWidth = 300;

    /**
     * The attribute that are used for image height
     *
     * @var int
     */
    protected $imageHeight = 300;
}
