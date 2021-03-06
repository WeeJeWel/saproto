<?php

namespace Proto\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityParticipation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities_users';

    /**
     * @return mixed The user this association is for.
     */
    public function user()
    {
        return $this->belongsTo('Proto\Models\User')->withTrashed();
    }

    /**
     * @return mixed The activity this association is for.
     */
    public function activity()
    {
        return $this->belongsTo('Proto\Models\Activity');
    }

    public function help()
    {
        return $this->belongsTo('Proto\Models\HelpingCommittee', 'committees_activities_id');
    }

    protected $guarded = ['id'];
}