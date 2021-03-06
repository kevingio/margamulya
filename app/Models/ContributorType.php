<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributorType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug_name'
    ];
}
