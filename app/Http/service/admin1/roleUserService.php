<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\roleUser;

use App\Sg\SgService;

class roleUserService  extends SgService
{

    public function create($data)
    {
        $masterItem=roleUser::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = roleUser::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = roleUser::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
