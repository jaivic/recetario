<?php

namespace App\Http\service\admin1;

use App\Http\Models\admin1\users;

use App\Sg\SgService;

class usersService  extends SgService
{

    public function create($data)
    {
        $masterItem=users::create($data);
    
         //*$ADDSINCRONIZACION$*/
        return $masterItem;
    }

    public function update($data,$id)
    {
         $masterItem = users::findOrFail($id);
         $masterItem->update($data);
    
        //*$ADDSINCRONIZACION$*/

        return  $masterItem;
    }
    public function delete($id)
    {
         $masterItem = users::findOrFail($id);
         $masterItem->delete();
        return  $masterItem;
    }
    //*$ADDSINCRONIZACIONMETHOD$*/
}
