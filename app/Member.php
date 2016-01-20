<?php

namespace Proto;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    public function user()
    {
        return $this->belongsTo('Proto\User');
    }
}