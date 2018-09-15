<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\categorias;

use App\Sg\SgService;

class categoriasService  extends SgService
{

    public function create($data)
    {
        $masterItem=categorias::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = categorias::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = categorias::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
