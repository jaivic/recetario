<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\permissionRole;

use App\Sg\SgService;

class permissionRoleService  extends SgService
{

    public function create($data)
    {
        $masterItem=permissionRole::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = permissionRole::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = permissionRole::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
