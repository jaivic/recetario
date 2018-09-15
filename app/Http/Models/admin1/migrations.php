<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class migrations extends Model
{
    
    public $table = 'migrations';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'migration',
    'batch'
    ];


    

    
}
