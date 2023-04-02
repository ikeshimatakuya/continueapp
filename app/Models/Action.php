<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public function trainings()
    {
        return $this->belongsTo(Training::class);
    }
}
