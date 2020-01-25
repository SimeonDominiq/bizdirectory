<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'contact_person',
        'phone',
        'email',
        'address',
        'website_url',
        'category_ids',
        'status'
    ];

    public function views() {
        return $this->hasMany('App\Models\ListingView', 'business_id', 'id');
    }
    
}
