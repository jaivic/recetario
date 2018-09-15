<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class roles extends Model
{
    
    public $table = 'roles';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'display_name',
    'description'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\HasMany
**/
public function permissions()
{
return $this->hasMany("App\Http\Models\admin1\\permissions","permission_id","role_id");
}/**
* @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
**/
public function users()
{
return $this->belongsToMany("App\Http\Models\admin1\\users","role_user","role_id","user_id");
}

    public function syncPermissions($itemsToSync)
    {

        $this->permissions()->each(function ($item) use ($itemsToSync) {
            if (! in_array($item->name, $itemsToSync)) {
                $item->delete();
            }
        });

        $newItems = collect($itemsToSync)->filter(function ($item) {
            return ! in_array($item, $this->permissions->pluck('name')->toArray());
        });

        $newItems->each(function ($item) {
            $this->permissions()->create(['name' => $item]);
        });
    }public function syncUsers($itemsToSync)
{
    $itemsToSync = collect($itemsToSync);
    $modelLists = users::all();
    $arrayExist = $modelLists->pluck("name")->toArray();
    $itemsToSync->each(function ($item) use ($arrayExist) {
        if (!in_array($item, $arrayExist)) {
            $this->users()->create(['name' => $item]);
        }
    });

    $itemReady = $this->users()->pluck("name")->toArray();
    $modelLists->each(function ($model) use ($itemsToSync, $itemReady) {
        if (in_array($model->name, $itemsToSync->toArray())) {
            if (!in_array($model->name, $itemReady)) {
                $this->users()->save($model);
            }
        } else {
            $this->users()->detach($model);
        }
    });
}
}
