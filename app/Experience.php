<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'experience';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'img_path', 'title', 'company_name', 'start_date', 'end_date', 'city', 'state', 'description', 'tasks', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
