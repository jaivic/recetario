<?php

namespace App\Http\Controllers;

use generator\base\gIndex;

use App\Http\Models\admin1\tags;
use App\Http\Models\admin1\posts;
use App\Http\Models\admin1\users;
use App\Http\Models\admin1\categories;


class aController
{
    public function pruebasyn()
    {

        $x = posts::find(18);
        $x->comments()->get();
        dd($x->comments()->get());
        $row[] = "admin";
        $row[] = "gue";
        $row[] = "juego";
        $row[]="este no";
        $x->syncCategories($row);
       
    }
    public function crearJsonIni()
    {
        $x = new gIndex();
        $x->crearJsonIni();
    }
    public function generadorAntiguo()
    {
        $x = new gIndex();
        $x->generadorAntiguo();
    }


    public function crearDesdeElJson()
    {

        $x = new gIndex();
        $x->crearDesdeElJson();

    }
    public function rollback()
    {

        $x = new gIndex();
        $x->rollback();
    }
    public function pruebademodelo()
    {
/*$x= posts::find(1);
$result["post"] = $x;
// $result["post"]->user_id= $x->users()->get()[0]->name;
$result["user"] = $x->users()->get();
$result["categories"] = $x->categories()->get();
$result["tags"] = $x->tags()->get();
return $this->sendResponse($result, "") ;*/

        $row = posts::find(1);
        $result = $row->toArray();


        $result["categories"] = [];
        if ($row->categories()) {
            $result["categories"] = $row->categories()->get();
        }

        $result["tags"] = [];
        if ($row->tags()) {
            $result["tags"] = $row->tags()->get();
        }

        $result["users"] = [];
        if ($row->users()) {
            $result["users"] = $row->users()->get();
        }


        return $this->sendResponse($result, 'success');
    }
}
