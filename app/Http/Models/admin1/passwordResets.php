<?php

namespace App\Http\Models\admin1;

use Illuminate\Database\Eloquent\Model; 


class passwordResets extends Model
{
    
    public $table = 'password_resets';
    public $timestamps = false;

    
    
    public $date = [  ];
    public $fillable = [
        
    'email',
    'token'
    ];


    

    
}
