<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Login extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'login';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user', 'token'
    ];
}