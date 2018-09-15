<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\permissions;

use App\Sg\SgService;

class permissionsService  extends SgService
{

    public function create($data)
    {
        $masterItem=permissions::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = permissions::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = permissions::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
