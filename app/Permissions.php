<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permissions extends EntrustPermission
{
    
    public $table = 'permissions';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'display_name',
    'description'
    ];


}
