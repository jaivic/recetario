<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\ingredienteReceta;

use App\Sg\SgService;

class ingredienteRecetaService  extends SgService
{

    public function create($data)
    {
        $masterItem=ingredienteReceta::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = ingredienteReceta::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = ingredienteReceta::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
