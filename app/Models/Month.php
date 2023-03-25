<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;
    // tableを指定
    protected $table = "months";
    
    protected $guarded = array('id');
    
    // 以下、バリデーションを設定
    public static $rules = array(
        'month_training_aim' => 'required' ,
        'month_training_aim_base' => 'required' ,
        'month_training_aim_upper' => 'required' ,
        'month_training_aim_lower' => 'required' ,
    );
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
