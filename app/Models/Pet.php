<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'age', 'users_id'];

    public function pet() 
    {
        return $this->belongsTo(Pet::class);
    }
}
