<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Club
 *
 * @package App
 * @property string $title
*/
class Club extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
    
    
    
}
