<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class permissions extends Model
{
    
    public $table = 'permissions';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'display_name',
    'description'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
**/
public function roles()
{
return $this->belongsToMany("App\Http\Models\admin1\\roles","permission_role","permission_id","role_id");
}

    public function syncRoles($itemsToSync)
{
    $itemsToSync = collect($itemsToSync);
    $modelLists = roles::all();
    $arrayExist = $modelLists->pluck("name")->toArray();
    $itemsToSync->each(function ($item) use ($arrayExist) {
        if (!in_array($item, $arrayExist)) {
            $this->roles()->create(['name' => $item]);
        }
    });

    $itemReady = $this->roles()->pluck("name")->toArray();
    $modelLists->each(function ($model) use ($itemsToSync, $itemReady) {
        if (in_array($model->name, $itemsToSync->toArray())) {
            if (!in_array($model->name, $itemReady)) {
                $this->roles()->save($model);
            }
        } else {
            $this->roles()->detach($model);
        }
    });
}
}
