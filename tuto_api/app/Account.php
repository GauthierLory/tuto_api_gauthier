<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'immeuble_id', 'content'
        ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function immeubles()
    {
        return $this->hasMany('App\Immeuble');
    }
}
