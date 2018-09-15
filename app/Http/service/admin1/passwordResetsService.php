<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\passwordResets;

use App\Sg\SgService;

class passwordResetsService  extends SgService
{

    public function create($data)
    {
        $masterItem=passwordResets::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = passwordResets::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = passwordResets::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
