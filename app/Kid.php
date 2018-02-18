<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kid
 *
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property string $year
 * @property string $sex
 * @property string $group
 * @property tinyInteger $licence
 * @property string $coach
 * @property string $club
*/
class Kid extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'year', 'sex', 'licence', 'ifsc_licence', 'group_id', 'user_id', 'club_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
//    public function setGroupIdAttribute($input)
//    {
//        $this->attributes['group_id'] = $input ? $input : null;
//    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCoachIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClubIdAttribute($input)
    {
        $this->attributes['club_id'] = $input ? $input : null;
    }
    
//    public function group()
//    {
//        return $this->belongsTo(Group::class, 'group_id')->withTrashed();
//    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id')->withTrashed();
    }
    
}
