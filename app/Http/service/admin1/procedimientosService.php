<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\procedimientos;

use App\Sg\SgService;

class procedimientosService  extends SgService
{

    public function create($data)
    {
        $masterItem=procedimientos::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = procedimientos::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = procedimientos::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
