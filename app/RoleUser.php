<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 


class RoleUser extends Model
{
    
    public $table = 'role_user';
    public $timestamps = false;

    
    protected $primaryKey="user_id";
    public $date = [  ];
    public $fillable = [
        
    'user_id',
    'role_id'
    ];


}
