<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'skill';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'img_path', 'title', 'duration', 'tasks', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
