<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class procedimientos extends Model
{
    
    public $table = 'procedimientos';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'procedimiento',
    'img'
    ];


    

    
}
