<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 *
 * @package App
 * @property string $title
 * @property string $years
*/
class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'year_from', 'year_to'];
    
    
    
}
