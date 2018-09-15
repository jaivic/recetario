<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class recetas extends Model
{
    
    public $table = 'recetas';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'name',
    'procedimiento_id',
    'categoria_id'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function categorias()
{
return $this->hasOne("App\Http\Models\admin1\\categorias","id","id");
}/**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function procedimientos()
{
return $this->hasOne("App\Http\Models\admin1\\procedimientos","id","id");
}/**
* @return \Illuminate\Database\Eloquent\Relations\HasMany
**/
public function ingredientes()
{
return $this->hasMany("App\Http\Models\admin1\\ingredientes","ingrediente_id","receta_id");
}

    public function syncCategorias($itemsToSync)
    {      
            $this->categorias()->update($itemsToSync);
    }public function syncProcedimientos($itemsToSync)
    {      
            $this->procedimientos()->update($itemsToSync);
    }public function syncIngredientes($itemsToSync)
    {

        $this->ingredientes()->each(function ($item) use ($itemsToSync) {
            if (! in_array($item->name, $itemsToSync)) {
                $item->delete();
            }
        });

        $newItems = collect($itemsToSync)->filter(function ($item) {
            return ! in_array($item, $this->ingredientes->pluck('name')->toArray());
        });

        $newItems->each(function ($item) {
            $this->ingredientes()->create(['name' => $item]);
        });
    }
}
