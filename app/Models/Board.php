<?php

namespace Proto\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use Auth;
use DB;


class Board extends Model
{

    // the table in the database used by this class
    protected $table = 'boards';

    protected $guarded = [];

    

    /**
     * @return mixed All users currently associated with this committee.
     */


    public function users()
    {

        return $this->belongsToMany('Proto\Models\User', 'committees_users', 'committee_id', 'committee_id')
            ->where(function ($query) {
                $query->whereNull('committees_users.deleted_at')
                    ->orWhere('committees_users.deleted_at', '>', Carbon::now());
            })
            ->where('committees_users.created_at', '<', Carbon::now())
            ->withPivot(array('id', 'role', 'edition', 'created_at', 'deleted_at'))
            ->withTimestamps()
            ->orderBy('pivot_created_at', 'desc');
    }

    public function image()
    {
        return $this->belongsTo('Proto\Models\StorageEntry', 'image_id');
    }
}