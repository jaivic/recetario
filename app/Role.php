<?php

namespace App;



use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    
    public $table = 'roles';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'display_name',
    'description'
    ];


}
