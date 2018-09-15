<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class ingredienteReceta extends Model
{
    
    public $table = 'ingrediente_receta';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'ingrediente_id',
    'receta_id',
    'cantidad',
    'unidad'
    ];


    /**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function ingredientes()
{
return $this->hasOne("App\Http\Models\admin1\\ingredientes","id","ingrediente_id");
}/**
* @return \Illuminate\Database\Eloquent\Relations\HasOne
**/
public function recetas()
{
return $this->hasOne("App\Http\Models\admin1\\recetas","id","receta_id");
}

    public function syncIngredientes($itemsToSync)
    {      
            $this->ingredientes()->update($itemsToSync);
    }public function syncRecetas($itemsToSync)
    {      
            $this->recetas()->update($itemsToSync);
    }
}
