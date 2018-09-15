<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class users extends Model
{
    
    public $table = 'users';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'email',
    'password',
    'remember_token'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\HasMany
**/
public function roles()
{
return $this->hasMany("App\Http\Models\admin1\\roles","role_id","user_id");
}

    public function syncRoles($itemsToSync)
    {

        $this->roles()->each(function ($item) use ($itemsToSync) {
            if (! in_array($item->name, $itemsToSync)) {
                $item->delete();
            }
        });

        $newItems = collect($itemsToSync)->filter(function ($item) {
            return ! in_array($item, $this->roles->pluck('name')->toArray());
        });

        $newItems->each(function ($item) {
            $this->roles()->create(['name' => $item]);
        });
    }
}
