<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Post extends Model implements TranslatableContract
{
    use Translatable,SoftDeletes,HasEagerLimit;
    use HasFactory;
    public $translatedAttributes = ['title', 'content','smallDesc','tags'];
    protected $fillable = ['id', 'user_id', 'image', 'category_id', 'created_at', 'updated_at', 'deleted_at'];

    public  function getCategoryOfPost(){
        return $this->belongsTo(Category::class,'category_id');
    }
    
    public  function getUserOfPost(){
        return $this->belongsTo(User::class,'user_id');
    }
}
