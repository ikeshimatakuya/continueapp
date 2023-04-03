<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
