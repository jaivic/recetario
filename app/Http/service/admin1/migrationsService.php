<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\migrations;

use App\Sg\SgService;

class migrationsService  extends SgService
{

    public function create($data)
    {
        $masterItem=migrations::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = migrations::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = migrations::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
