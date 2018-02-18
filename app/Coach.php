<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coach
 *
 * @package App
 * @property string $name
 * @property string $club
*/
class Coach extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'club_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClubIdAttribute($input)
    {
        $this->attributes['club_id'] = $input ? $input : null;
    }
    
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id')->withTrashed();
    }
    
}
