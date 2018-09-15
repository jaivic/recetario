<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\roles;

use App\Sg\SgService;

class rolesService  extends SgService
{

    public function create($data)
    {
        $masterItem=roles::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = roles::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = roles::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
