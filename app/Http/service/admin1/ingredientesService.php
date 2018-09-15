<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\ingredientes;

use App\Sg\SgService;

class ingredientesService  extends SgService
{

    public function create($data)
    {
        $masterItem=ingredientes::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = ingredientes::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = ingredientes::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
