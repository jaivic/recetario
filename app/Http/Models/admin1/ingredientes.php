<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class ingredientes extends Model
{
    
    public $table = 'ingredientes';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'tipo',
    'descripcion',
    'stock',
    'precio',
    'impuesto_id'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
**/
public function recetas()
{
return $this->belongsToMany("App\Http\Models\admin1\\recetas","ingrediente_receta","ingrediente_id","receta_id");
}

    public function syncRecetas($itemsToSync)
{
    $itemsToSync = collect($itemsToSync);
    $modelLists = recetas::all();
    $arrayExist = $modelLists->pluck("name")->toArray();
    $itemsToSync->each(function ($item) use ($arrayExist) {
        if (!in_array($item, $arrayExist)) {
            $this->recetas()->create(['name' => $item]);
        }
    });

    $itemReady = $this->recetas()->pluck("name")->toArray();
    $modelLists->each(function ($model) use ($itemsToSync, $itemReady) {
        if (in_array($model->name, $itemsToSync->toArray())) {
            if (!in_array($model->name, $itemReady)) {
                $this->recetas()->save($model);
            }
        } else {
            $this->recetas()->detach($model);
        }
    });
}
}
