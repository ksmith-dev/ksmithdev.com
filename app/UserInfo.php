<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'user_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'building_number', 'address', 'city', 'state', 'zip_code', 'zip_code_ext', 'phone' ,'title', 'bio', 'gender'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
