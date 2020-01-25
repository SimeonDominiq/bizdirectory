<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingView extends Model
{
    protected $fillable = [
        'business_id',
        'ip_address',
        'user_agent'
    ];
}
