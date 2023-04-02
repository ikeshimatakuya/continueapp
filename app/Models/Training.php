<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    // tableを指定(なんでかエラー出るしコメントアウト)
    //protected $table = "traninings";
    
    protected $guarded = array('id');
    
    // 以下、バリデーションを設定
    public static $rules = array(
        'training_aim' => 'required' ,
        'training_aim_base' => 'required' ,
        'training_aim_upper' => 'required' ,
        'training_aim_lower' => 'required' ,
    );
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function actions()
    {
        return $this->hasmany(Action::class);
    }
}
