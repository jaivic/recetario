<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\recetas;

use App\Sg\SgService;

class recetasService  extends SgService
{

    public function create($data)
    {
        $masterItem=recetas::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = recetas::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = recetas::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
