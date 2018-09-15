<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class permissionRole extends Model
{
    
    public $table = 'permission_role';
    public $timestamps = false;

    
    protected $primaryKey="permission_id";
    public $date = [  ];
    public $fillable = [
        
    'permission_id',
    'role_id'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function permissions()
{
return $this->hasOne("App\Http\Models\admin1\\permissions","id","permission_id");
}/**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function roles()
{
return $this->hasOne("App\Http\Models\admin1\\roles","id","role_id");
}

    public function syncPermissions($itemsToSync)
    {      
            $this->permissions()->update($itemsToSync);
    }public function syncRoles($itemsToSync)
    {      
            $this->roles()->update($itemsToSync);
    }
}
