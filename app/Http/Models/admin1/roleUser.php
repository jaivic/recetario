<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class roleUser extends Model
{
    
    public $table = 'role_user';
    public $timestamps = false;

    
    protected $primaryKey="user_id";
    public $date = [  ];
    public $fillable = [
        
    'user_id',
    'role_id'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function roles()
{
return $this->hasOne("App\Http\Models\admin1\\roles","id","role_id");
}/**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function users()
{
return $this->hasOne("App\Http\Models\admin1\\users","id","user_id");
}

    public function syncRoles($itemsToSync)
    {      
            $this->roles()->update($itemsToSync);
    }public function syncUsers($itemsToSync)
    {      
            $this->users()->update($itemsToSync);
    }
}
